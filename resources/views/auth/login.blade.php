<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - No Fence Market</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md border border-gray-100">
        <!-- Logo and Header -->
        <div class="text-center mb-6">
            
            <h2 class="text-2xl font-bold text-gray-800">Sign In</h2>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       class="mt-1 w-full p-2 border border-gray-200 rounded-md bg-gray-50" 
                       required 
                       autofocus 
                       autocomplete="username" 
                       value="{{ old('email') }}">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" 
                       type="password" 
                       name="password" 
                       class="mt-1 w-full p-2 border border-gray-200 rounded-md bg-gray-50" 
                       required 
                       autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" 
                           type="checkbox" 
                           class="rounded border-gray-300 text-blue-500 h-4 w-4" 
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-sm text-blue-600 hover:text-blue-700">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <!-- Buttons -->
            <div class="space-y-4">
                <button type="submit" 
                        class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Log In
                </button>
                
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="block w-full py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 text-center">
                        Sign Up
                    </a>
                @endif
            </div>
        </form>
    </div>
</body>
</html>