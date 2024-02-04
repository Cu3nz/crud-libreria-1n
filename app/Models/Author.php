<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;


    protected $fillable = ['nombre' , 'apellidos'];


    //todo Estamos en autores, por lo tanto yo tengo que apuntar a libros, un autor cuantos libros puede tener? Muchos 

    //todo Por lo tanto a tener muchos libros el nombre de la funcion se define en plural y HasMany porque tiene muchos.

    public function books(){
        return $this -> hasMany(Book::class); //* Un autor puede tener muchos libros
    }


}
