<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Catalogo</title>
</head>
<body class="bg-gray-100">
    <x-crud-navbar />
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Catálogo de Libros</h1>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($books as $book)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2">{{ $book->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $book->author }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Stock: {{ $book->stock }}</span>
                        @auth
                            <button 
                               <!--  onclick="openRentModal({{ $book->id }})" -->
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md {{ $book->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $book->stock <= 0 ? 'disabled' : '' }}
                            >
                                {{ $book->stock <= 0 ? 'Sin Stock' : 'Rentar' }}
                            </button>
                        @else
                            <a href="{{ route('Auth.login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Iniciar Sesión
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal de Renta -->
    @auth
    <div id="rentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg max-w-md w-full">
            <h2 class="text-2xl font-bold mb-4">Rentar Libro</h2>
            <form id="rentForm" action="{{ route('CRUD.rent') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" id="bookId">
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="rental_days">
                        Días de Renta
                    </label>
                    <input 
                        type="number" 
                        name="rental_days" 
                        id="rental_days"
                        min="1"
                        max="30"
                        value="7"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required
                    >
                    <p class="text-sm text-gray-500 mt-1">Máximo 30 días</p>
                </div>

                <div class="flex justify-end space-x-4">
                    <button 
                        type="button"
                        onclick="closeRentModal()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md"
                    >
                        Cancelar
                    </button>
                    <button 
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md"
                    >
                        Confirmar Renta
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endauth

    <script>
        function openRentModal(bookId) {
            document.getElementById('bookId').value = bookId;
            document.getElementById('rentModal').classList.remove('hidden');
            document.getElementById('rentModal').classList.add('flex');
        }

        function closeRentModal() {
            document.getElementById('rentModal').classList.add('hidden');
            document.getElementById('rentModal').classList.remove('flex');
            document.getElementById('rental_days').value = '7';
        }
    </script>
</body>
</html>