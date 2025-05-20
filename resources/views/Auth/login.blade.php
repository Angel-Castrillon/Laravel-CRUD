<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login</title>
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

            <h2 class="text-center text-sm font-medium mb-6">Inicia sesión con tu cuenta</h2>
            
            <!-- formulario -->
            <form method="POST" action="{{ route('Auth.postLogin') }}">
                @csrf
                
                @session('error')
                    <div class="">
                        {{ $value }}
                    </div>
                @endsession

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm text-gray-700 mb-1">{{ __('Email Address') }}</label>
                    <input type="email" name="email" id="email"
                        class="w-full rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                        placeholder="name@example.com" required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm text-gray-700 mb-1">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                        placeholder="••••••••" required>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Recordar + Olvidé -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                    <input type="checkbox" name="rememberMe" class="h-4 w-4 text-b rounded focus:ring-blue-500">
                    <span class="ml-2 text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                    <a href="#!" class="text-blue-600 hover:underline">{{ __('Forgot password?') }}</a>
                </div>
                <!-- Botón submit -->
                    <div>
                    <button type="submit" class="">
                        {{ __('Login') }}
                    </button>
                    </div>
                    <!-- Registro -->
                    <div>
                    <a href="{{ route('Auth.register') }}" class="">{{ __('Register') }}</a>
                    </div>
            </form>


        </div>
    </section>
</body>
</html>