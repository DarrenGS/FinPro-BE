<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sweet Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-4 px-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-pink-600">Sweet Shop 🍭</h1>
        <div class="flex items-center space-x-6">
            {{-- Saldo User --}}
            @auth
                <div class="text-pink-600 font-medium hover:underline">
                    Balance: Rp {{ number_format(auth()->user()->money, 0, ',', '.') }}
                </div>
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

            {{-- Navigation --}}
            <nav>
                @auth
                    <a href="{{ route('logout') }}" class="text-red-600 mr-4">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="text-green-600">Register</a>
                @endauth
            </nav>
        </div>
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
