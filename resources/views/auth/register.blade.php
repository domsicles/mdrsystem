<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MiniSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-center text-2xl font-bold mb-4">Register</h2>

        @if($errors->any())
            <p class="text-red-500 text-center">{{ $errors->first() }}</p>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" class="w-full p-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded-lg" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <small class="text-gray-500 text-sm">
                    Must be at least 8 characters and include an uppercase letter, a number, and a special character.
                </small>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full p-2 border rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-green-500 text-white p-2 rounded-lg">Sign Up</button>
        </form>

        <p class="text-center mt-4">Already have an account? 
            <a href="{{ route('login') }}" class="text-blue-500">Log in</a>
        </p>
    </div>

</body>
</html>
