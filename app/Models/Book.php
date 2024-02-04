<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    protected $fillable = ['titulo' , 'sinopsis' , 'imagen' , 'precio' , 'stock' , 'estado' , 'author_id'];

    //todo Un libro cuantos autores puede tener? 1

    //todo El nombre de la funcion en singular porque un libro SOLO puede tener 1 autor y por eso tambien defino el belongsTO
    public function author(){
        return $this -> belongsTo(Author::class); //* Un libro solo puede tener un autor
    }

}
