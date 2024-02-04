<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $authors = [
            'Carlos' => 'Ruiz Zafón',
            'Arturo' => 'Pérez-Reverte',
            'Javier' => 'Cercas',
            'Almudena' => 'Grandes',
            'Antonio' => 'Muñoz Molina',
            'María' => 'Dueñas',
            'Fernando' => 'Aramburu',
            'Ildefonso' => 'Falcones',
        ];
        

        
        foreach ($authors as $nombre => $apellidos) {
            Author::create(compact('nombre' , 'apellidos')); //* Llamamos al modelo y creamos los autores pasando por compact el nombre y los apellidos
        }

        

    }
}
