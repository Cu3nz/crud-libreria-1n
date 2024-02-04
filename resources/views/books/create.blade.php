@extends('plantilla.principal')

@section('titulo')
Crear nuevo libro


@endsection


@section('cabecera')

Crear nuevo libro

@endsection

@section('contenido')


<div class="container p-8 mx-auto">
    <div class="w-1/2 mx-auto p-6 rounded-xl bg-gray-400">
       <form action="{{route('books.store')}}" method="post" enctype="multipart/form-data" > {{-- todo El formulario lo gestiona la ruta clients.store que es la que se encarga de validar y crear el cliente --}}
            @csrf
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo </label>
                {{-- todo El old es para que guarde el si hemos cometido algun fallo de validacion en el formulario, para no tener que escribir todo de nuevo. --}}
                <input type="text" name="titulo"value="{{ old('titulo') }}" id="titulo" placeholder="Titulo del libro" class=" mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('titulo')
                    <x-inputerror>
                        {{$message}}
                    </x-inputerror>
                @enderror
                <div class="mb-6">
                    <label for="precioArticulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Sinopsis</label>
                    <textarea id="sinpsis" type="text" id="sinpsis" step="0.01" name="sinopsis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Sinopsis del libro" rows="10" >{{old('sinopsis')}}</textarea>
                 @error('sinopsis')
                     <x-inputerror>
                        {{$message}}
                    </x-inputerror>
                 @enderror
                </div>
                <div class="mb-6">
                    <label for="precioArticulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                       Precio</label>
                    <input id="precioArticulo" value="{{old('precio')}}" type="number" id="precio" step="0.01" name="precio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Precio" >
                  @error('precio')
                      <x-inputerror>
                        {{$message}}
                      </x-inputerror>
                  @enderror
                </div>
                <div class="mb-6">
                    <label for="precioArticulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Stock</label>
                    <input id="precioArticulo" value="{{old('stock')}}" type="number" id="stock" step="0.01" name="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="stock" >
                  @error('stock')
                      <x-inputerror>
                        {{$message}}
                      </x-inputerror>
                  @enderror
                </div>

                <div class="mb-6">
                    <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Estado</label>
                    {{-- todo Que me marque si el checkbox si lo que vale estado dentro de old es publicado --}}
                    <input id="estado" value="PUBLICADO" @checked(old('estado') == "PUBLICADO") type="checkbox"  id="stock" step="0.01" name="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" >
                  @error('estado')
                      <x-inputerror>
                        {{$message}}
                      </x-inputerror>
                  @enderror
                </div>


                <div class="mb-6">
                    <label for="autor">Autor</label>
                    <select class="bg-gray-50 border mt-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="author_id" id="autor">
                        <option value="">--------------------- SELECIONA UNA OPCION ----------------</option>
                        @foreach ($autor as $item)
                            <option value="{{$item -> id}}" @selected(old('author_id') == $item -> id)>{{$item -> nombre}}</option>
                        @endforeach
                    </select>
                    @error('author_id')
                    <x-inputerror>
                      {{$message}}
                    </x-inputerror> 
                    @enderror

                </div>


                <div class="mb-4">
                    <div class="flex w-full">
                        <div class="w-1/2 mr-2">
                            <label for="imagen"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Imagen</label>
                            <input type="file" value="{{old('imagen')}}" id="imagen" oninput="img.src=window.URL.createObjectURL(this.files[0])"
                                name="imagen" accept="image/*"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        @error('imagen')
                            {{-- ! Para los errores --}}
                            <x-inputerror>
                                {{ $message }}
                            </x-inputerror>
                        @enderror
                        <div class="w-1/2">
                            <img src="{{Storage::url("noimage.png")}}"
                                  class="h-72 rounded w-full bg-cover bg-center bg-no-repeat border-4 border-black"
                                id="img">
                        </div>
                    </div>

                <div class=" mt-2 flex flex-row-reverse">
                    <button type="submit" name="btn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-plus mr-2"></i>Crear Libro
                    </button>
                    <button type="reset" class="mr-2 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-blue-800">
                        <i class="fas fa-paintbrush mr-2"></i>LIMPIAR
                    </button>
                    <a href="{{route('books.index')}}" class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">
                        <i class="fas fa-backward mr-2"></i>VOLVER
                    </a>
                </div>

        </form>
    </div>
</div>



@endsection