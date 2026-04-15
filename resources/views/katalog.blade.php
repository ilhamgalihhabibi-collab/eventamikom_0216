<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Sistem Informasi AMIKOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex h-screen overflow-hidden font-sans text-slate-800">

    <aside class="w-64 bg-white shadow-lg border-r border-slate-200 flex flex-col justify-between">
        <div>
            <div class="p-6 border-b border-slate-200">
                <h2 class="text-xl font-bold text-indigo-600">Event Hub</h2>
                <p class="text-xs text-slate-500 mt-1">S1 Sistem Informasi<br>Universitas AMIKOM Yogyakarta</p>
            </div>
            <nav class="p-4 space-y-2">
                <a href="/" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 text-slate-600 font-medium">Profil</a>
                <a href="/katalog" class="block py-2.5 px-4 rounded transition duration-200 bg-indigo-50 text-indigo-600 font-semibold">Katalog</a>
                <a href="/bantuan" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 text-slate-600 font-medium">Bantuan</a>
            </nav>
        </div>
        <div class="p-6 border-t border-slate-200">
            <a href="/" class="block text-center bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 hover:shadow-md transition duration-300">
                Kembali ke Home
            </a>
        </div>
    </aside>

    <main class="flex-1 p-10 overflow-y-auto flex items-start justify-center">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-slate-200 w-full max-w-4xl mt-10">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Katalog Event</h1>
            <p class="text-slate-500 mb-6">Daftar kegiatan dan event mahasiswa.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border border-slate-200 rounded-lg p-4 hover:shadow-md transition">
                    <h3 class="font-bold text-lg text-slate-800">Seminar Nasional IT</h3>
                    <p class="text-sm text-slate-500 mt-1">Tanggal: 20 Mei 2026</p>
                </div>
                <div class="border border-slate-200 rounded-lg p-4 hover:shadow-md transition">
                    <h3 class="font-bold text-lg text-slate-800">Workshop UI/UX</h3>
                    <p class="text-sm text-slate-500 mt-1">Tanggal: 15 Juni 2026</p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>