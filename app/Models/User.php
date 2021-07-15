<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//DECLARAMOS EL USO DEL PACKAGE PASSPORT
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    //UN USER PUEDE TENER MUCHOS POSTS
    public function posts (){
        return $this -> hasMany(Post::class);
    }
    //UN USER, PUEDE ESTAR EN MUCHAS PARTIES
    public function membershipe (){
        return $this -> hasMany(Membershipe::class);
    }

    //UN USER, PUEDE CREAR EN MUCHAS PARTIES
    public function user (){
        return $this -> hasMany(Party::class);
    }

    //UN USER PUEDE TENER MUCHOS COMENTARIOS
    public function comment(){
        return $this -> hasMany(Comment::class);
    }

    //UN USER PUEDE TENER MUCHOS GAMES
    public function game(){
        return $this -> hasMany(Game::class);
    }

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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
