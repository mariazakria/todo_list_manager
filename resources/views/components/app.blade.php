<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Todo List Manager' }}</title>
    <meta name="description" content="{{ $description ?? 'Manage your tasks efficiently' }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    
    {{ $styles ?? '' }}
</head>
<body class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen flex flex-col font-sans">
    <header class="bg-indigo-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold tracking-tight">
                <a href="/" class="">
                    Todo List Manager
                </a>
            </h1>
            
            @guest
            <nav>
                <ul class="flex space-x-4">
                    <x-nav href="/register" :active="request()->is('register')" class="hover:bg-indigo-500 px-3 py-2 rounded-md transition-colors">
                        Register
                    </x-nav>
                    <x-nav href="/login" :active="request()->is('login')" class="hover:bg-indigo-500 px-3 py-2 rounded-md transition-colors">
                        Login
                    </x-nav>
                </ul>
            </nav>
            @endguest
            
            @auth
            <nav>
                <ul class="flex space-x-4 items-center">
                
                    <x-nav>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:text-indigo-200 font-semibold bg-red-500 hover:bg-red-600 px-3 py-2 rounded-md transition-colors">
                                Logout
                            </button>
                        </form>
                    </x-nav>
                </ul>
            </nav>
            @endauth
        </div>
    </header>


    <main class="flex-grow   px-4 py-4">
        <div class=" border-t-6 border-indigo-600">
            @yield('content')
        </div>
    </main>
    
    <footer class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm">
                &copy; {{ date('Y') }} Todo List Manager. 
                <span class="ml-4 opacity-75">Organize Your Tasks, Boost Your Productivity</span>
            </p>
        </div>
    </footer>

    <script>
        // Optional: Add some interactivity
        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('nav a');
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', (e) => {
                    e.target.classList.add('scale-105');
                });
                link.addEventListener('mouseleave', (e) => {
                    e.target.classList.remove('scale-105');
                });
            });
        });
    </script>
</body>
</html>