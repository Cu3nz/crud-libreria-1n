@extends('plantilla.principal')

@section('titulo')

Editanto autor

@endsection


@section('cabecera')

Edianto autor <strong>{{$author -> nombre}}</strong>

@endsection

@section('contenido')


<div class="container p-8 mx-auto">
    <div class="w-3/4 mx-auto p-6 rounded-xl bg-gray-400">
       <form action="{{route('authors.update' , $author)}}" method="post"> {{-- todo El formulario lo gestiona la ruta clients.store que es la que se encarga de validar y crear el cliente --}}
            @csrf
            @method('put')
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del Cliente</label>
                {{-- todo El old es para que guarde el si hemos cometido algun fallo de validacion en el formulario, para no tener que escribir todo de nuevo. --}}
                <input type="text" name="nombre"value="{{ old('nombre' , $author -> nombre) }}" id="nombre" placeholder="Nombre del Cliente..." class=" mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('nombre')
                    <x-inputerror>
                        {{$message}}
                    </x-inputerror>
                @enderror
                <div class="mb-6">
                    <label for="precioArticulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Apellidos del Cliente</label>
                    <input id="precioArticulo" value="{{old('apellidos' , $author -> apellidos )}}" type="text" id="stockArticulo" step="0.01" name="apellidos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Apellidos del cliente" >
                 @error('apellidos')
                     <x-inputerror>
                        {{$message}}
                    </x-inputerror>
                 @enderror
                </div>

                <div class="flex flex-row-reverse">
                    <button type="submit" name="btn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-plus mr-2"></i>Actualizar Autor
                    </button>
                    <button type="reset" class="mr-2 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-blue-800">
                        <i class="fas fa-paintbrush mr-2"></i>LIMPIAR
                    </button>
                    <a href="{{route('authors.index')}}" class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">
                        <i class="fas fa-backward mr-2"></i>VOLVER
                    </a>
                </div>

        </form>
    </div>
</div>



@endsection