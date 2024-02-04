<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));


        return [
            //

            'titulo' => fake() -> words(2, true),
            'sinopsis' => fake() -> text(),
            'precio' => fake() -> randomFloat(2 , 1 , 100),
            'stock' => random_int(1, 100),
            'estado' => random_int(1,2),
            'imagen' => "books/" . fake()->picsum("public/storage/books", 640, 400, false),
            'author_id' => Author::all() -> random() -> id
        ];
    }
}
