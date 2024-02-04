<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::orderBy('id', 'desc')->paginate(5);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $autor = Author::select('id', 'nombre')->orderBy('nombre')->get();
        return view('books.create', compact('autor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([

            'titulo' => ['required' , 'string', 'min:3', 'unique:books,titulo'],
            'sinopsis' => ['required' , 'string', 'min:10'],
            'precio' => ['required', 'numeric', 'min:1', 'max:100'],
            'stock' => ['required', 'integer', 'min:1', 'max:100'],
            'estado' => ['nullable'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'author_id' => ['required', 'exists:authors,id']
        ]);

       
        Book::create([
            'titulo' => ucfirst($request->titulo),
            'sinopsis' => ucfirst($request->sinopsis),
            'precio' => (float) (($request->precio)),
            'stock' => (int) (($request->stock)),
            'estado' => ($request->estado ? "PUBLICADO" : "NO PUBLICADO"),
            //todo Comprobacion para la imagen 

            //* Comprobamos que si se ha subido una imagen gracias a ($request -> imagen)

            //* Si se ha subido la almacenamos en la carpeta books gracias al metodo store que almacena y le da un nombre a la imagen

            //* Si no, le ponemos la imagen por defectos

            'imagen' => ($request -> imagen) ? $request -> imagen -> store('books') : "noimage.png",

            'author_id' => $request -> author_id
        ]);

        return redirect() -> route('books.index') -> with('mensaje' , "libro creado");

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
        $autor = Author::select('id', 'nombre')->orderBy('nombre')->get();
        return view('books.update' , compact('book' , 'autor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //

        $request -> validate([
            'titulo' => ['required' , 'string', 'min:3', 'unique:books,titulo,'. $book -> id],
            'sinopsis' => ['required' , 'string', 'min:10'],
            'precio' => ['required', 'numeric', 'min:1', 'max:100'],
            'stock' => ['required', 'integer', 'min:1', 'max:100'],
            'estado' => ['nullable'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'author_id' => ['required', 'exists:authors,id']
        ]);

        //todo Comprobaciones para la iamgen

        $imagen = ($book -> imagen); //* Almaceno la imagen actual que tiene el libro (la que se ha puesto en el create)

        if ($request -> imagen){ //* Si existe esto, es porque se ha subido una nueva imagen, por lo tanto tengo que borrar la imagen actual del libro.
        //! pero antes de borrarla tengo que comprobar que sea distinta de la default (noimagen.png)

        if (basename($imagen) != "noimage.png"){ //* Si el nombre de la imagen actual del libro en la base de datos es distinta de noimagen.png
            Storage::delete($imagen); //* Elimino la imagen actual del libro
        }

        $imagen = $request -> imagen -> store('books'); //* $imagen contiene ahora la nueva imagen que se guarda en la carpeta books y con un nombre aleatorio gracias al metodo store.

        }

        $book -> update([

            'titulo' => ucfirst($request->titulo),
            'sinopsis' => ucfirst($request->sinopsis),
            'precio' => (float) (($request->precio)),
            'stock' => (int) (($request->stock)),
            'estado' => ($request->estado ? "PUBLICADO" : "NO PUBLICADO"),
            //todo Mirar el bloque de arriba para la imagen
            'imagen' => $imagen,
            'author_id' => $request -> author_id

        ]);

        return redirect() -> route('books.index') -> with('mensaje' , 'Libro actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //

        //todo antes de borrar el libro, tengo que comprobar que la imagaen que tiene ese libro no sea la de por defecto

        if (basename($book -> imagen) != "noimage.png"){ //* Si el nombre de la iamgen es distinta a la default (noimagen.png)
            Storage::delete($book -> imagen); //? Elimino la imagen de la carpeta
        }

        $book -> delete();


        return redirect() -> route('books.index') -> with('mensaje' , 'Libro eliminado correctamente');

    }
}
