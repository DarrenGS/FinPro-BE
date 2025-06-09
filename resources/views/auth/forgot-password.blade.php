@extends('layouts.app') 
@section('content')
    {{-- Main container for the form, adjusted to be wider (sm:max-w-lg) --}}
    <div class="w-full sm:max-w-lg mx-auto px-6 py-8 bg-white overflow-hidden sm:rounded-3xl shadow-xl border border-pink-100 relative z-10">
        {{-- Candy shop header --}}
        <div class="text-center mb-8">
            <span class="text-6xl" role="img" aria-label="lollipop">🍬</span>
            <h2 class="text-3xl font-bold text-pink-600 mt-4 mb-2">Forgot Your Sweets?</h2>
            <p class="text-gray-600 text-sm">No problem! Just enter your email and we'll send you a treat to reset your password.</p>
        </div>

        {{-- Session Status (e.g., "We have emailed your password reset link!") --}}
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="text-pink-600 font-semibold mb-2 block">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full p-2 border rounded candy-input-style"> {{-- Apply candy-input-style --}}
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                {{-- Back to Login Link --}}
                <a class="underline text-sm text-pink-500 hover:text-pink-700 transition duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-300" href="{{ route('login') }}">
                    {{ __('Back to Login') }}
                </a>

                {{-- Email Password Reset Link Button --}}
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-6 rounded-full shadow-lg transform transition duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-300">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
@endsection
