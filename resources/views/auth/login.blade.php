@extends('layouts.app')

@section('content')
    {{-- Main container for the form, adjusted to be wider (sm:max-w-lg) --}}
    <div class="w-full sm:max-w-lg mx-auto px-6 py-8 bg-white overflow-hidden sm:rounded-3xl shadow-xl border border-pink-100 relative z-10">
        {{-- Candy shop header --}}
        <div class="text-center mb-8">
            <span class="text-6xl" role="img" aria-label="candy">🍬</span>
            <h2 class="text-3xl font-bold text-pink-600 mt-4 mb-2">Welcome Back, Sweetie!</h2>
            <p class="text-gray-600 text-sm">Log in to continue your delicious journey.</p>
        </div>

        {{-- Session Status (e.g., "You have been logged out.") --}}
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="text-pink-600 font-semibold mb-2 block">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full p-2 border rounded candy-input-style"> {{-- Apply candy-input-style --}}
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="text-pink-600 font-semibold mb-2 block">Secret Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full p-2 border rounded candy-input-style"> {{-- Apply candy-input-style --}}
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                {{-- Forgot Password Link --}}
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-pink-500 hover:text-pink-700 transition duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-300" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                {{-- Login Button --}}
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-6 rounded-full shadow-lg transform transition duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-300">
                    {{ __('Log in') }}
                </button>
            </div>

            {{-- Link to Register Page --}}
            <div class="text-center mt-6 pt-4 border-t border-pink-100">
                <p class="text-gray-600 text-sm">Don't have an account?</p>
                <a href="{{ route('register') }}" class="text-pink-500 hover:text-pink-700 font-semibold underline transition duration-300">
                    {{ __('Register Here') }}
                </a>
            </div>
        </form>
    </div>
@endsection
