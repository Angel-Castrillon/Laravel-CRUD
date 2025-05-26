<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extender Renta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <x-crud-navbar />
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-6">Extender Período de Renta</h1>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-6">
                    <h2 class="text-xl font-semibold">{{ $rental->book->title }}</h2>
                    <p class="text-gray-600">Autor: {{ $rental->book->author }}</p>
                </div>

                <div class="mb-6">
                    <p class="text-gray-600">Fecha actual de renta: {{ \Carbon\Carbon::parse($rental->rental_date)->format('d/m/Y') }}</p>
                    <p class="text-gray-600">Fecha actual de devolución: {{ \Carbon\Carbon::parse($rental->return_date)->format('d/m/Y') }}</p>
                </div>

                <form action="{{ route('CRUD.update', $rental->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label for="rental_days" class="block text-gray-700 text-sm font-bold mb-2">
                            Días adicionales de renta
                        </label>
                        <input 
                            type="number" 
                            name="rental_days" 
                            id="rental_days"
                            min="1"
                            max="30"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required
                        >
                        <p class="text-sm text-gray-500 mt-1">Máximo 30 días adicionales</p>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('CRUD.rentals') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            Extender Renta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>