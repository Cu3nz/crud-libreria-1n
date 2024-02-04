<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table -> string('titulo') -> unique();
            $table -> string('sinopsis');
            $table -> integer('precio');
            $table -> integer('stock');
            $table -> enum('estado' , ['PUBLICADO' , 'NO PUBLICADO']);
            $table -> string('imagen');
            //! Tambien puede ser por la funcion que se le pone a la 1:N
            //todo IMPORTANTE  dentro de foreignId tengo que definir el nombre de la tabla en la base de datos y despues el atributo en este caso id
            $table -> foreignId('author_id') -> constrained() -> onDelete('cascade'); //* Llave foranea con la llave primaria de la tabla de autores 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
