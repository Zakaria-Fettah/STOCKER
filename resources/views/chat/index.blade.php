@extends('layout.mainlayout')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    .chat-container {
        margin-top: 100px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 90%;
        margin: 100px auto 0;
    }

    .user-list {
        max-height: 500px;
        overflow-y: auto;
        border-right: 1px solid #dee2e6;
    }

    .user-item {
        cursor: pointer;
        transition: background 0.3s;
    }

    .user-item:hover {
        background-color: #f8f9fa;
    }

    .chat-box {
    height: 400px;
    overflow-y: auto;
    padding: 15px;
    background-image: url('/build/img/chat.jpg');
    background-size: cover; /* S'assure que l'image couvre toute la zone */
    background-position: center center; /* Positionne l'image au centre */
}

    .chat-message {
        max-width: 75%;
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 10px;
        word-wrap: break-word;
    }

    .sent {
        background: #d4edda;
        align-self: flex-end;
        text-align: right;
    }

    .received {
        background: #fff;
        align-self: flex-start;
        border: 1px solid #dee2e6;
    }

    .input-area {
        padding: 10px;
        border-top: 1px solid #dee2e6;
        background: #fff;
    }

    .date-label {
        font-size: 12px;
        margin: 10px 0;
    }

    .read-status i {
        font-size: 14px;
        margin-left: 5px;
    }

    audio {
        width: 100%;
        max-width: 250px;
        margin-top: 5px;
    }
</style>

<div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 60px;">
    <div class="row chat-container">
        <div class="col-md-4 user-list p-3">
            <h4 class="mb-3">Utilisateurs</h4>
            <input type="text" id="search-user" class="form-control mb-3" placeholder="Rechercher un utilisateur...">
            <ul class="list-group" id="user-list">
                @foreach($users as $user)
                    @php
                        $latestMessage = \App\Models\Chat::where(function($query) use ($user) {
                            $query->where('user_id', Auth::id())
                                  ->where('receiver_id', $user->id);
                        })->orWhere(function($query) use ($user) {
                            $query->where('user_id', $user->id)
                                  ->where('receiver_id', Auth::id());
                        })
                        ->orderBy('created_at', 'desc')
                        ->first();
                    @endphp
                    <li class="list-group-item user-item d-flex justify-content-between align-items-center" data-id="{{ $user->id }}">
                        <div class="d-flex flex-column">
                            <strong>{{ $user->name }}</strong>
                            @if($latestMessage)
                                <div class="d-flex align-items-center gap-2">
                                    @if($latestMessage->message_type == 'audio')
                                        <span class="text-muted small">🎤 Message vocal</span>
                                    @else
                                        <span class="text-muted small">{{ Str::limit($latestMessage->message, 30) }}</span>
                                    @endif
                                    @if ($latestMessage->created_at->isToday())
                                        <span class="text-muted" style="font-size: 10px;">
                                            {{ $latestMessage->created_at->format('H:i') }}
                                        </span>
                                    @else
                                        <span class="text-muted" style="font-size: 10px;">
                                            {{ $latestMessage->created_at->format('d/m H:i') }}
                                        </span>
                                    @endif
                                    @if($latestMessage->read_status == 1)
                                        <span class="text-primary read-status"><i class="bi bi-check-all"></i></span>
                                    @else
                                        <span class="text-muted read-status"><i class="bi bi-check-circle"></i></span>
                                    @endif
                                </div>
                            @else
                                <span class="text-muted small">Aucun message</span>
                            @endif
                        </div>
                        <div class="text-end">
                            @if($user->unread_count > 0)
                                <span class="badge bg-success rounded-pill">{{ $user->unread_count }}</span>
                            @endif
                            @if($user->is_blocked)
                                <button class="btn btn-sm btn-success unblock-user ms-2" data-id="{{ $user->id }}">Débloquer</button>
                            @else
                                <button class="btn btn-sm btn-danger block-user ms-2" data-id="{{ $user->id }}">Bloquer</button>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8 d-flex flex-column">
            <h4 class="p-3 mb-0">Discussion</h4>
            <div id="chat-box" class="chat-box d-flex flex-column">
                <p class="text-center text-muted">Sélectionnez un utilisateur pour démarrer une discussion.</p>
            </div>
            <div class="input-area d-flex align-items-center">
                <input type="text" id="message-input" class="form-control rounded-pill me-2" placeholder="Écrire un message...">
                <button id="send-text" class="btn btn-success rounded-circle send-btn"><i class="bi bi-send"></i></button>
                <button id="record-audio" class="btn btn-primary rounded-circle mic-btn ms-2"><i class="bi bi-mic"></i></button>
            </div>
        </div>
    </div>
</div>

<audio id="audio-player" controls style="display: none;"></audio>
<input type="hidden" id="receiver_id">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let receiverId = null;
        let mediaRecorder = null;
        let audioChunks = [];

        $('.user-item').click(function () {
            receiverId = $(this).data('id');
            $('#receiver_id').val(receiverId);
            loadMessages(receiverId);
        });

        function loadMessages(userId) {
            if (!userId) return;

            $('#chat-box').html('<p class="text-center text-muted">Chargement des messages...</p>');
            
            let currentUserId = {{ auth()->id() }};
            let lastDate = null;

            $.get('/messages/' + userId, function (messages) {
                let chatContent = "";
                
                if (messages.length === 0) {
                    chatContent = '<p class="text-center text-muted">Aucun message disponible</p>';
                } else {
                    messages.forEach(function (message) {
                        let messageContent = message.message ? 
                            `<div class="chat-message p-2 ${message.user_id == currentUserId ? 'sent' : 'received'}">${message.message}</div>` 
                            : "";

                        let audioContent = message.file_path ? 
                            `<audio controls><source src="${message.file_path}" type="audio/mpeg"></audio>` 
                            : "";
                        
                        let messageTime = message.created_at ? formatTime(message.created_at) : "";

                        let readStatus = message.read_status == 1 ?
                            `<span class="text-primary read-status"><i class="bi bi-check-all"></i></span>` 
                            : `<span class="text-muted read-status"><i class="bi bi-check-circle"></i></span>`;

                        if (message.formatted_date !== lastDate) {
                            chatContent += `<div class="date-label text-center text-muted">${message.formatted_date}</div>`;
                            lastDate = message.formatted_date;
                        }

                        chatContent += `<div class="d-flex flex-column ${message.user_id == currentUserId ? 'align-items-end' : 'align-items-start'} mb-2">
                            ${messageContent}
                            ${audioContent}
                            <div class="d-flex align-items-center gap-2">
                                <small class="text-muted">${messageTime}</small>
                                ${message.user_id == currentUserId ? readStatus : ''}
                            </div>
                        </div>`;
                    });
                }

                $('#chat-box').html(chatContent);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }).fail(function () {
                $('#chat-box').html('<p class="text-center text-danger">Une erreur est survenue lors du chargement des messages.</p>');
            });
        }

        function markMessagesAsRead(userId) {
            $.post('/messages/read', { user_id: userId, _token: '{{ csrf_token() }}' }, function () {
                $('.user-item[data-id="' + userId + '"] .badge').remove();
            });
        }

        $('#chat-box').on('DOMNodeInserted', function () {
            let userId = $('#receiver_id').val();
            if (userId) {
                markMessagesAsRead(userId);
            }
        });

        function formatTime(datetime) {
            let date = new Date(datetime);
            let hours = date.getHours().toString().padStart(2, '0');
            let minutes = date.getMinutes().toString().padStart(2, '0');
            return `${hours}:${minutes}`;
        }

        let isRecording = false;

        $('#record-audio').click(async function () {
            if (!isRecording) {
                let stream = await navigator.mediaDevices.getUserMedia({audio: true});
                mediaRecorder = new MediaRecorder(stream);
                audioChunks = [];

                mediaRecorder.ondataavailable = event => audioChunks.push(event.data);

                mediaRecorder.start();
                isRecording = true;
                $('#record-audio').html("<i class='bi bi-record-circle-fill'></i>");
            } else {
                mediaRecorder.stop();
                isRecording = false;
                $('#record-audio').html("<i class='bi bi-mic'></i>");

                mediaRecorder.onstop = async function () {
                    let audioBlob = new Blob(audioChunks, {type: 'audio/mpeg'});
                    let formData = new FormData();
                    formData.append('audio', audioBlob, "audio.mp3");
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('receiver_id', receiverId);

                    fetch('/send-audio', {
                        method: 'POST',
                        body: formData
                    }).then(response => response.json())
                        .then(data => {
                            console.log('Audio envoyé :', data);
                            loadMessages(receiverId);
                        })
                        .catch(error => console.error('Erreur :', error));
                };
            }
        });

        $('#send-text').click(function () {
            let message = $('#message-input').val().trim();
            if (message !== '' && receiverId) {
                $.post('/send-message', {
                    _token: "{{ csrf_token() }}",
                    receiver_id: receiverId,
                    message: message
                }, function (response) {
                    $('#message-input').val('');
                    loadMessages(receiverId);
                }).fail(function () {
                    console.error("Échec de l'envoi du message.");
                });
            }
        });

        $("#search-user").on("keyup", function () {
            let query = $(this).val();
            if (query.length > 0) {
                $.get('/search-users', { query: query }, function (data) {
                    let usersHtml = "";
                    data.forEach(user => {
                        usersHtml += `<li class="list-group-item user-item d-flex align-items-center" data-id="${user.id}">
                            <i class="bi bi-person-circle me-2"></i> ${user.name}
                        </li>`;
                    });
                    $("#user-list").html(usersHtml);
                });
            } else {
                location.reload();
            }
        });

        $(".block-user, .unblock-user").click(function () {
            let userId = $(this).data("id");
            let isBlocking = $(this).hasClass("block-user");
            let route = isBlocking ? "/block-user" : "/unblock-user";

            $.post(route, {
                _token: "{{ csrf_token() }}",
                blocked_user_id: userId
            }, function (response) {
                alert(response.message);

                if (isBlocking) {
                    $(`.block-user[data-id='${userId}']`).replaceWith(
                        `<button class="btn btn-sm btn-success unblock-user ms-auto" data-id="${userId}">Débloquer</button>`
                    );
                } else {
                    $(`.unblock-user[data-id='${userId}']`).replaceWith(
                        `<button class="btn btn-sm btn-danger block-user ms-auto" data-id="${userId}">Bloquer</button>`
                    );
                }
            }).fail(function () {
                alert("Une erreur est survenue. Veuillez réessayer.");
            });
        });
    });
</script>

@endsection
