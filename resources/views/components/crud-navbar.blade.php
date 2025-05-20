<nav class="flex items-center justify-between bg-gray-500 space-x-32 p-4">
    <div class="flex items-center space-x-10">
        <img src="{{ asset('storage/images/example_icon.png') }}" alt="" class="w-10 h-10 ">
        <a href="{{ route('CRUD.index') }}">Inicio</a>
        <a href="{{ route('CRUD.catalogo') }}">Catalogo</a>
    </div>
   
    <div class="relative inline-block">
    @if (Auth::check())
        <button id="userMenuButton" class="pointer-events-none">
            <img onclick="menuToggle()" src="https://unavatar.io/x/dragonian_x" alt="" class="w-12 h-12 rounded-full mr-16 border border-gray-200 pointer-events-auto">
        </button>
        <div id="userMenu" class="hidden absolute mt-[1rem] right-0 bg-gray-100 shadow-lg rounded-sm w-40 z-50">
            <a href="{{ route('CRUD.rentals') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 hover:rounded-sm">Mis E-books</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 hover:rounded-sm">Configuración</a>
            <a href="{{ route('Auth.logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 hover:rounded-sm">Cerrar sesión</a>
        </div>
        @elseif (!Auth::check())
        <a href="{{ route('Auth.login') }}" class="">Iniciar sesión</a>
    </div>
    @endif
</nav>

<script>
    function menuToggle() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
    }


    document.addEventListener('click', function(event) {
        const button = document.getElementById('userMenuButton');
        const menu = document.getElementById('userMenu');
        
    if(menu && button){

        if (!menu.classList.contains('hidden') && 
            !button.contains(event.target) && 
            !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    }
    });
</script>