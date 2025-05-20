<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Register</title>
</head>
<body>
    <x-crud-navbar></x-crud-navbar>
    
    <section class="w-full pt-[60px] pb-[100px]">
        <div class="h-[575px] w-[430px] bg-slate-500">
            <!-- Logo   -->
            <div class="text-center mb-4">
                <a href="#!">
                    <img src="{{ asset('storage/images/example_icon.png') }}" class="mx-auto w-12" alt="">
                </a>                            
            </div>  

            <h2 class="text-center text-sm font-medium mb-6">Registrate</h2>
            
            <!-- formulario -->
            <form method="POST" action="{{ route('Auth.postRegister') }}">
                @csrf
                
                @session('error')
                    <div class="">
                        {{ $value }}
                    </div>
                @endsession
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm text-gray-700 mb-1">Nombre de usuario</label>
                    <input type="text" name="name" id="name"
                        class="w-full rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        placeholder="nombre de usuario" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm text-gray-700 mb-1">Correo electrónico</label>
                    <input type="email" name="email" id="email"
                        class="w-full rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                        placeholder="name@example.com" required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Email Confimation -->
                <div>
                    <label for="email_confirmation" class="block text-sm text-gray-700 mb-1">Confirmación de correo electrónico</label>
                    <input type="email" name="email_confirmation" id="email_confirmation"
                        class="w-full rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email_confirmation') border-red-500 @enderror"
                        placeholder="Coloca de nuevo tu correo" autocomplete="off" onpaste="return false" required>
                    @error('email_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm text-gray-700 mb-1">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                        placeholder="••••••••" required>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm text-gray-700 mb-1">Confirmación de contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                        placeholder="Coloca de nuevo tu contraseña" autocomplete="off" oncopy="return false" onpaste="return false" oncut="return false" required>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm text-gray-700 mb-1">Número de teléfono</label>
                    <input type="text" name="phone" id="phone"
                        class="w-full rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
                        placeholder="Coloca tu número de teléfono" autocomplete="off">
                    @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Birth Date -->
                <div>
                    <label for="birth_date" class="block text-sm text-gray-700 mb-1">Fecha de nacimiento</label>
                    <input type="date" name="birth_date" id="birth_date"
                        class="w-full rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('birth_date') border-red-500 @enderror"
                        placeholder="Coloca tu fecha de nacimiento" autocomplete="off">
                    @error('birth_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botón submit -->
                    <div>
                    <button type="submit" class="">
                        Registrarse
                    </button>
                    </div>

                    <!-- Registro -->
                    <div>
                    <a href="{{ route('Auth.login') }}" class="">Iniciar sesión</a>
                    </div>
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-2 rounded">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            </form>


        </div>
    </section>
</body>
</html>