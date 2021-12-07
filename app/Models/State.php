<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = "states";

    protected $fillable = 
    [
        "serialNumber",
        "type",
        "publicationDate",
        "style",
        "commentary",
        "imageFile",
        "user_id"

    ];
    

    //Campos visibles en el JSON
    protected $hidden = ['creates_at','updated_at'];

    //relaciones de estados con un usuario (unica)

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
