<?php

namespace App\Http\Controllers;

use App\Models\BlockedUser;
use App\Models\Chat;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class ChatController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

public function index() {
    $blockedUsers = \App\Models\BlockedUser::where('user_id', Auth::id())->pluck('blocked_user_id')->toArray();

    $users = \App\Models\User::where('id', '!=', Auth::id())->get()->map(function ($user) use ($blockedUsers) {
        $user->is_blocked = in_array($user->id, $blockedUsers);
        
        // Fetch latest message
        $user->latest_message = \App\Models\Chat::where(function($query) use ($user) {
            $query->where('user_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('user_id', $user->id)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'desc')->first();

        // ** Count unread messages ** 
        $user->unread_count = \App\Models\Chat::where('user_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->where('read_status', 0)
            ->count();

        return $user;
    });

    return view('chat.index', compact('users'));
}


public function markAsRead(Request $request) {
    \App\Models\Chat::where('user_id', $request->user_id)
        ->where('receiver_id', Auth::id())
        ->where('read_status', 0)
        ->update(['read_status' => 1]);

    return response()->json(['success' => true]);
}




public function getMessages($userId) {
    if (\App\Models\BlockedUser::where('user_id', Auth::id())->where('blocked_user_id', $userId)->exists()) {
        return response()->json(['error' => 'تم حظر هذا المستخدم.'], 403);
    }

    $messages = Chat::where(function ($query) use ($userId) {
        $query->where('user_id', Auth::id())->where('receiver_id', $userId);
    })->orWhere(function ($query) use ($userId) {
        $query->where('user_id', $userId)->where('receiver_id', Auth::id());
    })->with('sender')->orderBy('created_at', 'asc')->get();

    
    $messages = $messages->map(function ($message) {
        $message->formatted_date = $this->formatDate($message->created_at);
        return $message;
    });

    return response()->json($messages);
}




private function formatDate($date)
{
    $carbonDate = Carbon::parse($date);
    
    if ($carbonDate->isToday()) {
        return 'Aujourd\'hui';
    } elseif ($carbonDate->isYesterday()) {
        return 'Hier';
    } else {
        return $carbonDate->format('d/m/Y'); 
    }
}



public function sendMessage(Request $request) {
    $isBlocked = BlockedUser::where('user_id', Auth::id())
        ->where('blocked_user_id', $request->receiver_id)
        ->exists();

    if ($isBlocked) {
        return response()->json(['error' => 'لا يمكنك إرسال رسائل لهذا المستخدم.'], 403);
    }

    $chat = Chat::create([
        'user_id' => auth()->id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
        'message_type' => 'text',
        'file_path' => null,
    ]);

    broadcast(new MessageSent($chat))->toOthers();
    return response()->json($chat);
}




public function sendAudioMessage(Request $request) {
    if ($request->hasFile('audio')) {
        $file = $request->file('audio');
        $path = $file->store('audio_messages', 'public'); //storage/app/public/audio_messages

        $chat = Chat::create([
            'user_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => null, 
            'message_type' => 'audio',
            'file_path' => "/storage/$path", 
        ]);

        broadcast(new MessageSent($chat))->toOthers();
        return response()->json($chat);
    }

    return response()->json(['error' => 'No audio file found'], 400);
}

public function searchUsers(Request $request)
{
    $query = $request->input('query');
    $users = \App\Models\User::where('name', 'like', "%{$query}%")
        ->where('id', '!=', Auth::id())
        ->get();

    return response()->json($users);
}


public function blockUser(Request $request) {
    $blocked = BlockedUser::create([
        'user_id' => Auth::id(),
        'blocked_user_id' => $request->blocked_user_id
    ]);

    return response()->json(['message' => 'تم حظر المستخدم بنجاح', 'blocked' => $blocked]);
}

public function unblockUser(Request $request) {
    BlockedUser::where('user_id', Auth::id())
        ->where('blocked_user_id', $request->blocked_user_id)
        ->delete();

    return response()->json(['message' => 'تم إلغاء الحظر بنجاح']);
}


}

