@extends('layouts.app')

@section('content')
    <div class="w-full sm:max-w-md mx-auto mt-6 px-6 py-8 bg-white overflow-hidden sm:rounded-3xl shadow-xl border border-pink-100 relative z-10">
        {{-- Candy shop header --}}
        <div class="text-center mb-8">
            <span class="text-6xl" role="img" aria-label="lollipop">🍭</span>
            <h2 class="text-3xl font-bold text-pink-600 mt-4 mb-2">Join Our Sweet Community!</h2>
            <p class="text-gray-600 text-sm">Register to explore a world of delicious treats.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="text-pink-600 font-semibold mb-2 block">Sweet Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full p-2 border rounded candy-input-style">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="text-pink-600 font-semibold mb-2 block">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full p-2 border rounded candy-input-style">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="text-pink-600 font-semibold mb-2 block">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full p-2 border rounded candy-input-style">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="text-pink-600 font-semibold mb-2 block">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full p-2 border rounded candy-input-style">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-4">
                {{-- Button/Link to Login Page --}}
                <a class="underline text-sm text-pink-500 hover:text-pink-700 transition duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-300" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>

                {{-- Register Button --}}
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-6 rounded-full shadow-lg transform transition duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-300">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
@endsection
