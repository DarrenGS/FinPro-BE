@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-pink-600 mb-6 text-center">Top Up Your Balance</h2>

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </span>
        </div>
    @endif

    <div class="text-center mb-6">
        <p class="text-lg text-gray-700">Current Balance:</p>
        <p class="text-4xl font-extrabold text-pink-700">Rp {{ number_format(auth()->user()->money, 0, ',', '.') }}</p>
    </div>

    <form method="POST" action="{{ route('balance.topup.process') }}">
        @csrf

        <div class="mb-4">
            <label for="amount" class="block text-gray-700 text-sm font-semibold mb-2">Amount to Top Up (Rp)</label>
            <input type="number" name="amount" id="amount" class="candy-input-style w-full"
                   placeholder="e.g., 50000" min="10000" required>
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-6 rounded-xl transition duration-300">
                Add Balance
            </button>
        </div>
    </form>
</div>
@endsection