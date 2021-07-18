<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//TABLA PIVOTE ENTRE MUCHOS A MUCHOS
class Membership extends Model
{
    use HasFactory;

    //ENCAPSULAMOS LOS ATRIBUTOS
    protected $fillable = [ 'party_id'];

    //LA TABLA PARTY_USER, PERTENECE A UN USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }
}
