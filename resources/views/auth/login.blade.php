<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-indigo-900 mb-6 text-center">Login Admin</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" required 
                    class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-indigo-600">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required 
                    class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-indigo-600">
            </div>

            <button type="submit" 
                class="w-full py-3 bg-indigo-900 text-white font-bold rounded-xl hover:bg-indigo-800 transition">
                Masuk
            </button>
        </form>
    </div>
</body>
</html>