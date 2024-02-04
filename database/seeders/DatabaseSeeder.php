<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //* Primero tenemos que llamar a autores, porque si la tablas autores no se hace los libros, por tener la llave foranea

        $this -> call(AuthorSeeder::class);

        //* Ahora borramos la carpetas books 

        Storage::deleteDirectory('books');

        //* La creamos 

        Storage::createDirectory('books');

        //* Hacemos los 50 libros 

        Book::factory(50) -> create();


    }
}
