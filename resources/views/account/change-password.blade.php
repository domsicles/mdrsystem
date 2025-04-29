@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
    <h2>Change Password</h2>

    <form action="{{ route('account.change-password') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="current_password" class="block text-gray-700">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="w-full px-4 py-2 border rounded" required>
            @error('current_password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="new_password" class="block text-gray-700">New Password</label>
            <input type="password" name="new_password" id="new_password" class="w-full px-4 py-2 border rounded" required>
            @error('new_password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="new_password_confirmation" class="block text-gray-700">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full px-4 py-2 border rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Change Password</button>
    </form>
@endsection
