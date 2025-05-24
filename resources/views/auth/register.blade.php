@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Register</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label>Name</label>
            <input type="text" name="name" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full p-2 border rounded">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Register</button>
    </form>
@endsection
