<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //ENCAPSULAMOS LOS ATRIBUTOS
    protected $fillable = [ 'description', 'party_id', 'user_id'];

    //UN POST PERTENECE A UN SOLO USUARIO
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //UN POST PERTENECE A UNA PARTY
    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    //UN POST PUEDE TENER MUCHOS COMENTARIOS
    // public function comment()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}
