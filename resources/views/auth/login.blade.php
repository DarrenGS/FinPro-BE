@extends('layouts.app', ['loginPage' => true])


@section('content')
    <h2 class="text-2xl font-bold mb-4">Login</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label>Email</label>
            <input type="email" name="email" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Login</button>
    </form>
@endsection
