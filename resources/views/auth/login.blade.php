<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MiniSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    if (window.history && window.history.pushState) {
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            window.history.go(1);
        };
    }
</script>

</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-center text-2xl font-bold mb-4">Login</h2>

        @if(session('success'))
            <p class="text-green-600 text-center">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <p class="text-red-500 text-center">{{ $errors->first() }}</p>
        @endif

        <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input 
                    type="text" 
                    name="username" 
                    class="w-full p-2 border rounded-lg" 
                    required 
                    autocomplete="off"
                >
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="w-full p-2 border rounded-lg" 
                    required 
                    autocomplete="new-password"
                >
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Login</button>
        </form>

        <p class="text-center mt-4">Don't have an account? 
            <a href="{{ route('register') }}" class="text-blue-500">Sign up</a>
        </p>
    </div>

</body>
</html>
