<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $autores = Author::orderBy('id' , 'desc') -> paginate(5);
        return view('autores.index' , compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('autores.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request -> validate([
            'nombre' => ['required' , 'string' , 'min:3' , 'unique:authors,nombre'],
            'apellidos' => ['required' , 'string' , 'min:5']
        ]);

        //* una vez pasada las validaciones

        Author::create([

            'nombre' => ucfirst($request -> nombre),
            'apellidos' => ucfirst($request -> apellidos)
        ]);



        return redirect() -> route('authors.index') -> with('mensaje' , 'Autor añadido correctamente');


    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //

        return view('autores.update' , compact('author'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //

        $request -> validate([
            'nombre' => ['required' , 'string' , 'min:3' , 'unique:authors,nombre,'. $author -> id],
            'apellidos' => ['required' , 'string' , 'min:5']
        ]);


        $author -> update([

            'nombre' => ucfirst($request -> nombre),
            'apellidos' => ucfirst($request -> apellidos)
        ]);



        return redirect() -> route('authors.index') -> with('mensaje' , 'Autor actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //

        $author -> delete();


        return redirect() -> route('authors.index') -> with('mensaje' , 'autor eliminado correctamnete');

    }
}
