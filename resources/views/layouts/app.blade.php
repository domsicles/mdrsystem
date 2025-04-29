<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MDRSystem')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script> <!-- Optional: Use Tailwind CSS -->
</head>
<body class="bg-gray-100">

    <!-- Navigation Bar -->
    <nav class="p-4 bg-blue-500 text-white flex justify-between items-center">
        <!-- Left Side - Dashboard Links -->
        <div class="flex space-x-4">
            <a href="{{ route('dashboard1') }}" class="bg-blue hover:bg-white hover:text-black hover:font-bold font-bold text-white px-4 py-2 rounded">Dashboard 1</a>
            <a href="{{ route('dashboard2') }}" class="bg-blue hover:bg-white hover:text-black hover:font-bold font-bold text-white px-4 py-2 rounded">Dashboard 2</a>
            <!-- Add other dashboard links if necessary -->
        </div>
        
        <div class="flex-1 flex justify-center items-center">
            <span class="text-white text-2xl font-bold">{{ Auth::user()->name ?? 'Guest' }}</span>
        </div>

        <!-- Right Side - Account Links and Logout Button -->
        <div class="relative">
        

    <!-- Button to Toggle Menu -->
    <button onclick="toggleMenu()" class="bg-blue hover:bg-white hover:text-black hover:font-bold font-bold text-white px-4 py-2 rounded focus:outline-none">
        Account Options 
    </button>

    <!-- Dropdown Menu -->
        <div id="accountMenu" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden">
            <a href="{{ route('account.show-change-password') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Change Password</a>
            <a href="{{ route('account.show-delete-account') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Delete Account</a>
            <form action="{{ route('logout') }}" method="POST" class="block">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">Logout</button>
            </form>
        </div>
    </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-4 p-4 bg-white shadow-lg">
        @yield('content')
    </div>

</body>

<script>
    function toggleMenu() {
        document.getElementById('accountMenu').classList.toggle('hidden');
    }
</script>
</html>
