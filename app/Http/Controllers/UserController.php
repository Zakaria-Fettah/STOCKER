<?php

    

namespace App\Http\Controllers;

    

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\User;

use Spatie\Permission\Models\Role;

use DB;

use Hash;

use Illuminate\Support\Arr;


use Illuminate\Support\Str;
use App\Notifications\NewUserNotification;


class UserController extends Controller

{



    



    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    


    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = auth()->user();
    
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profiles'), $filename);
    
            $user->profile_image = $filename;
            $user->save();
        }
    
        return back()->with('success', 'Image mise à jour avec succès');
    }
    





    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function index(Request $request)
     {
         $search = $request->input('search');
     
         $data = User::when($search, function ($query, $search) {
                 return $query->where('name', 'like', "%{$search}%")
                              ->orWhere('email', 'like', "%{$search}%");
             })
             ->orderBy('id','DESC')
             ->paginate(5);
     
         return view('users.index', compact('data', 'search'))
             ->with('i', ($request->input('page', 1) - 1) * 5);
     }
     

    

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $roles = Role::pluck('name','name')->all();

        return view('users.create',compact('roles'));

    }

    

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */


     public function showPermissions()
     {
         $user = Auth::user();
     
         if ($user->hasRole('admin')) {
             // Admin voit tout
             $permissions = Permission::all();
         } else {
             // User normal voit juste ce qu'il a ajouté
             $permissions = Permission::where('created_by', $user->id)->get();
         }
     
         return view('permissions.index', compact('permissions'));
     }
     

     public function store(Request $request)
     {
         $this->validate($request, [
             'name' => 'required',
             'email' => 'required|email|unique:users,email',
             'roles' => 'required'
         ]);
     
         // Mot de passe par défaut
         $defaultPassword = '123456';
     
         $input = $request->all();
         $input['password'] = Hash::make($defaultPassword);
     
         $user = User::create($input);
     
         // Assigner le rôle
         $user->assignRole($request->input('roles'));
     
         // Envoyer l'email avec mot de passe par défaut
         $user->notify(new NewUserNotification($user->email, $defaultPassword));
     
         return redirect()->route('users.index')
                          ->with('success','Utilisateur ajouté et email envoyé.');
     }
     
     

    

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $user = User::find($id);

        return view('users.show',compact('user'));

    }

    

    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $user = User::find($id);

        $roles = Role::pluck('name','name')->all();

        $userRole = $user->roles->pluck('name','name')->all();

    

        return view('users.edit',compact('user','roles','userRole'));

    }

    

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

     public function update(Request $request, $id)
     {
         $this->validate($request, [
             'name' => 'required',
             'email' => 'required|email|unique:users,email,' . $id,
             'roles' => 'required'
         ]);
     
         $user = User::findOrFail($id);
         $input = $request->all();
     
         // Si le mot de passe est vide, on lui attribue un mot de passe par défaut
         if (empty($request->password)) {
             $input['password'] = Hash::make('123456');  // Mot de passe par défaut
         } else {
             // Sinon, on hash le nouveau mot de passe
             $input['password'] = Hash::make($request->password);
         }
     
         $user->update($input);
     
         // Mettre à jour les rôles
         $user->syncRoles($request->input('roles'));
     
         return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès');
     }
     

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        User::find($id)->delete();

        return redirect()->route('users.index')

                        ->with('success','User deleted successfully');

    }

}