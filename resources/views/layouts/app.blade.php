<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- Added Inter font as per previous styling --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- CANDY SHOP THEME STYLES --}}
        <style>
            /* Custom background for the whole page */
            body {
                background-color: #fce4ec; /* Light pink background */
                background-image: linear-gradient(135deg, #fce4ec 0%, #e0f2f7 100%); /* Soft gradient */
                min-height: 100vh; /* Ensure background covers full viewport height */
                display: flex; /* Use flexbox for overall layout */
                flex-direction: column; /* Stack header, main, and footer vertically */
                font-family: 'Inter', sans-serif; /* Using Inter, as specified for consistency */
                /* Remove default margin/padding for full background coverage */
                margin: 0;
                padding: 0;
            }

            /* Main content area should stretch to fill available space */
            main {
                flex-grow: 1; /* Allows main to take up remaining vertical space */
                /* Removed centering flex properties to allow content to flow naturally */
                /* display: flex; align-items: center; justify-content: center; */
                padding: 1.5rem; /* py-6 px-4 converted to a single padding for consistency */
            }

            /* Specific styling for standard input elements to match candy-input style */
            .candy-input-style {
                border-radius: 0.75rem !important; /* rounded-xl */
                padding: 0.75rem 1rem !important; /* py-3 px-4 */
                border-color: #f48fb1 !important; /* pink-400 */
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* shadow-sm */
                transition: all 0.2s ease-in-out;
            }
            .candy-input-style:focus {
                border-color: #ff80ab !important; /* pink-300 */
                ring: 2px !important;
                ring-color: #ff80ab !important; /* pink-300 */
                outline: none !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased"> 
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 flex justify-between items-center">
                <a href="
                    @auth
                        @if (Auth::user()->isAdmin()?? false) 
                            {{ route('admin.dashboard') }}
                        @else
                            {{ route('home') }}
                        @endif
                    @else
                        
                        {{ route('home') }}
                    @endauth
                " class="text-xl font-bold text-pink-600 hover:text-pink-700 transition duration-200">
                    Sweet Shop 🍭
                </a>

                <div class="flex items-center space-x-6">
                {{-- Saldo User --}}
                @auth
                    <a href="{{ route('balance.topup.form') }}" class="text-pink-600 font-medium hover:underline flex items-center space-x-1">
                        <span>Balance:</span>
                        <span class="font-bold">Rp {{ number_format(auth()->user()->money, 0, ',', '.') }}</span>
                    </a>
                @endauth

                {{-- Cart Menu --}}
                @auth
                    @php
                        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                    @endphp
                    <a href="{{ route('cart.index') }}" class="text-pink-600 font-medium hover:underline">
                        🛒 Cart ({{ $cartCount }})
                    </a>
                @endauth
                
                <nav>
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-red-500 hover:underline" type="submit">Logout</button>
                        </form>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="text-blue-600 mr-4">Login</a>
                        <a href="{{ route('register') }}" class="text-green-600">Register</a>
                    @endguest
                </nav>
            </div>
        </header>

        <main class="py-6 px-4"> 
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
                    {{ session('status') }}
                </div>
            @endif

            @isset($loginPage)
                @if (session('login_failed'))
                    <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded">
                        {{ session('login_failed') }}
                    </div>
                @elseif ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded">
                        {{ $errors->first() }}
                    </div>
                @endif
            @else
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif

            @yield('content')
        </main>
    </body>
</html>
