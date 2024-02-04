@extends('plantilla.principal')

@section('titulo')
    Principal autores
@endsection


@section('cabecera')
    Tabla de autores
@endsection

@section('contenido')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-row-reverse mb-2">
            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('books.create')}}"> <i class="fas fa-add mr-2"></i>Crear nuevo libro</a>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-16 py-3">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Titulo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sinopsis
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stock
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Autor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($books as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="p-4">
                            <img src="{{ Storage::url($item->imagen) }}" class="w-16 md:w-32 max-w-full max-h-full"
                                alt="Apple Watch">
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{ $item->titulo }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->sinopsis }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{ $item->precio }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{ $item->stock }}
                        </td>
                        <td @class(["px-6 py-4 font-semibold",
                        "text-green-600" => $item -> estado == "PUBLICADO",
                        "text-red-600" => $item -> estado == "NO PUBLICADO",])>
                            {{ $item-> estado }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{$item -> author -> nombre}} {{-- todo author es el nombre de la funcion --}}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{route('books.destroy' , $item)}}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{route('books.edit' , $item)}}"><i class="fas fa-edit text-yellow-600"></i></a>
                                <button type="submit"><i class="fas fa-trash text-red-600"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-2">
        {{$books -> links()}}
        </div>

@endsection
