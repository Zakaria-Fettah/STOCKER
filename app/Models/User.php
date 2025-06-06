<?php

  

namespace App\Models;

  

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

  

class User extends Authenticatable

{
    use  HasFactory, hasroles;
    public function messagesSent() {
        return $this->hasMany(Message::class, 'sender_id');
    }
    
    public function messagesReceived() {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

  

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name',

        'email',

        'password',

    ];

  

    /**

     * The attributes that should be hidden for serialization.

     *

     * @var array

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];

  

    /**

     * The attributes that should be cast.

     *

     * @var array

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

}