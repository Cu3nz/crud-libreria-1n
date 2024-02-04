<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMaillabe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    //

    public function pintarFormulario(){

        return view('contactoform.formulario');

    }



    public function procesarFormulario(Request $request){


        //todo Empezamos a hacer las validaciones 

        $request -> validate([

            'nombre' => ['required' , 'string' , 'min:3'],
            'email' => ['required' , 'email'],
            'contenido' => ['required' , 'string' , 'min:10']
        ]);

        //todo Hacemos un bloque try catch, para poder capturar cualquier tipo de error

        try {
            Mail::to('sergio@example.com') -> send(new ContactoMaillabe(ucwords($request -> nombre) , $request -> email , ucfirst($request -> contenido)));
            return redirect() -> route('home') -> with('mensaje' , 'El correo se ha enviado correctamente');
        } catch (\Exception $ex) {
            dd("Error al enviar el correo" . $ex -> getMessage());
            return redirect() -> route('home') -> with('mensaje' , 'El correo no se ha podido enviar, por favor intentalo luego mas tarde');
        }


    }

}
