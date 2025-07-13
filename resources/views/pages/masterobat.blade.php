@extends('layout')

@section('content')
<div class="bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold mb-4 text-blue-700">Daftar Obat</h2>

    <!-- Search Form -->
    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ $keyword ?? '' }}"
            class="border px-4 py-2 rounded w-64" placeholder="Cari kode/nama obat">
        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded ml-2 hover:bg-blue-700">Cari</button>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-collapse">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Kode</th>
                    <th class="px-4 py-2 border">Nama Obat</th>
                    <th class="px-4 py-2 border">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $item)
                    <tr class="text-sm hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ $index + $data->firstItem() }}</td>
                        <td class="px-4 py-2 border">{{ $item->obatalkes_kode }}</td>
                        <td class="px-4 py-2 border">{{ $item->obatalkes_nama }}</td>
                        <td class="px-4 py-2 border">{{ $item->stok }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        @if ($data->onFirstPage())
            <span class="text-gray-400">← Sebelumnya</span>
        @else
            <a href="{{ $data->previousPageUrl() }}&search={{ $keyword }}" class="text-blue-600 hover:underline">← Sebelumnya</a>
        @endif

        <span class="text-sm text-gray-600">Halaman {{ $data->currentPage() }} dari {{ $data->lastPage() }}</span>

        @if ($data->hasMorePages())
            <a href="{{ $data->nextPageUrl() }}&search={{ $keyword }}" class="text-blue-600 hover:underline">Selanjutnya →</a>
        @else
            <span class="text-gray-400">Selanjutnya →</span>
        @endif
    </div>
</div>
@endsection
