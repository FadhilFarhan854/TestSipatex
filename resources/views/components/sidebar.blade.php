<aside class="w-64 bg-white">
    <div class="p-4 border-b border-gray-200 flex items-center gap-3">
        <h1 class="text-xl font-semibold text-gray-800">E-Resep</h1>
    </div>

    <div class="p-4">
        <nav class="space-y-2">
            <a href="/obat"
                class="block px-4 py-2 rounded-md {{ Request::is('/obat') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                List Obat
            </a>
            <a href="/signa"
                class="block px-4 py-2 rounded-md {{ Request::is('/signa') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                List Signa
            </a>
            <a href="/obat/input"
                class="block px-4 py-2 rounded-md {{ Request::is('resep/cetak') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Input Resep
            </a>
            <a href="/racikan"
                class="block px-4 py-2 rounded-md {{ Request::is('resep/cetak') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                List Resep
            </a>
        </nav>
    </div>
</aside>
