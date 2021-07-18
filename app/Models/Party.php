<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    //ENCAPSULAMOS LOS ATRIBUTOS. QUE SON LOS QUE RECIBE POSTMAN
    protected $fillable = ['name', 'user_id', 'game_id'];

    //UNA PARTY PUEDE TENER MUCHOS POSTS
    public function post (){
        return $this -> hasMany(Post::class);
    }

    //UNA PARTY SOLO PUEDE TENER UN JUEGO
    public function game(){
        return $this -> belongsTo(Game::class);
    }

    //UNA PARTY PUEDE SER DE UN USER
    public function user(){
        return $this -> belongsTo(User::class);
    }

    //RELACION DE MUCHOS A MUCHOS ENTRE USERS Y PARTIES
    public function membership(){
        return $this -> hasMany(Membership::class);
    }
}
