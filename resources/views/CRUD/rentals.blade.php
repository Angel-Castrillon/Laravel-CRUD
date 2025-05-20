<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <x-crud-navbar />
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Mis E-books Alquilados</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($rentals as $rental)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">{{ $rental->book->title }}</h2>
                        <p class="text-gray-600 mb-2">Autor: {{ $rental->book->author }}</p>
                        <p class="text-gray-600 mb-2">Fecha de inicio: {{ \Carbon\Carbon::parse($rental->fecha_inicio)->format('d/m/Y') }}</p>
                        <p class="text-gray-600 mb-4">Fecha de fin: {{ \Carbon\Carbon::parse($rental->fecha_fin)->format('d/m/Y') }}</p>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('CRUD.edit', $rental->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Editar</a>
                            <form action="{{ route('CRUD.destroy', $rental->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('¿Estás seguro de que quieres eliminar este alquiler?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
