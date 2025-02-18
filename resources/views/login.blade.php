<!-- login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>NAMA EKSKUL</h2>
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $key => $value)
                        <li>{{ $value }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <form method="post" action="/loginn">
            @csrf
            @error('login')
                <div class=" text-red-500 bg-red-100 border border-red-400 p-2 rounded-md mb-4 text-sm">
                    {{ $message }}
                </div>
            @enderror
            <!-- <input type="text" name="nis" placeholder="NIS" value="{{ Session::get('nis') }}" required><br> -->
            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <div class=" text-red-500 bg-red-100 border border-red-400 p-2 rounded-md mt-1">
                    {{ $message }}
                </div>
            @enderror
            <br>
            <input type="password" name="pw" placeholder="Password" required>
            @error('pw')
                <div class="text-red-500 bg-red-100 border border-red-400 p-2 rounded-md mt-1">
                    {{ $message }}
                </div>
            @enderror
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
