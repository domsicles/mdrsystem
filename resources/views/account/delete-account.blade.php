@extends('layouts.app')

@section('title', 'Delete Account')

@section('content')
    <h2>Delete Account</h2>

    <form action="{{ route('account.delete-account') }}" method="POST">
        @csrf
        @method('DELETE') <!-- Method spoofing -->
        
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded" required>
            @error('password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete Account</button>
    </form>

@endsection
