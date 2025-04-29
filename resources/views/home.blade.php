<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            background-color: white;
            padding: 40px 60px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .subtitle {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.2rem;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn:active {
            transform: scale(0.98);
        }

        /* Mobile Responsiveness */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="title">Welcome, {{ Auth::user()->name ?? 'Guest' }}!</h1>
        <p class="subtitle">Your gateway to managing hazard and population data with ease.</p>

        <div class="btn-group">
            <a href="{{ route('dashboard1') }}" class="btn">Go to Dashboard 1</a>
            <a href="{{ route('dashboard2') }}" class="btn">Go to Dashboard 2</a>
        </div>
    </div>

</body>
</html>
