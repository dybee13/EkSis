<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="flex justify-center items-center h-screen bg-linear-to-t from-sky-300 to-indigo-500">
    <div class="bg-white shadow-lg rounded-lg flex w-[60%] p-6">
        <!-- Image Section -->
        <div class="w-1/2 flex justify-center items-center">
        <img src="{{ asset('storage/blogs/logotext.png') }}" class="mx-auto w-full mb-4" alt="">
        </div>
        
        <!-- Login Form Section -->
        <div class="w-1/2 p-6 text-center flex flex-col justify-center">
            <!-- <img src="{{ asset('storage/blogs/logo.png') }}" class="mx-auto w-32 mb-4" alt=""> -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Login</h2>
            <form method="post" action="/loginn" class="space-y-4">
                @csrf
                @error('login')
                    <div class="text-red-500 bg-red-100 border border-red-400 p-2 rounded-md text-sm">
                        {{ $message }}
                    </div>
                @enderror
                
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('email')
                    <div class="text-red-500 bg-red-100 border border-red-400 p-2 rounded-md text-sm">
                        {{ $message }}
                    </div>
                @enderror
                
                <input type="password" name="pw" placeholder="Password" required
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('pw')
                    <div class="text-red-500 bg-red-100 border border-red-400 p-2 rounded-md text-sm">
                        {{ $message }}
                    </div>
                @enderror
                
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition">Login</button>
            </form>
            <!-- <a href="#" class="text-blue-500 text-sm block mt-4">Forgot Password?</a> -->
        </div>
    </div>
</body>
</html>