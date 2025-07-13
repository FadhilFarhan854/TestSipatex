@extends('layout')

@section('content')
<div class="bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold mb-4 text-blue-700">Daftar Racikan</h2>

    <!-- Form Search -->
    <form method="GET" class="mb-4 flex gap-3 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari nama racikan..."
               class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-400">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Cari
        </button>
    </form>
    <div class="overflow-x-auto">
        <table class="w-full border border-collapse table-auto">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Nama Racikan</th>
                    <th class="px-4 py-2 border">Signa</th>
                    <th class="px-4 py-2 border">Jumlah Obat</th>
                    <th class="px-4 py-2 border">ID Resep</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr onclick="showDetail({{ $item->id }})" class="cursor-pointer hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ $index + $data->firstItem() }}</td>
                        <td class="px-4 py-2 border">{{ $item->nama_racikan }}</td>
                        <td class="px-4 py-2 border">{{ $item->signa->signa_nama ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $item->details->count() }} Obat</td>
                        <td class="px-4 py-2 border">{{ $item->resep->id ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex justify-between items-center">
        @if ($data->onFirstPage())
            <span class="text-gray-400">← Sebelumnya</span>
        @else
            <a href="{{ $data->previousPageUrl() }}" class="text-blue-600 hover:underline">← Sebelumnya</a>
        @endif

        <span class="text-sm text-gray-600">Halaman {{ $data->currentPage() }} dari {{ $data->lastPage() }}</span>

        @if ($data->hasMorePages())
            <a href="{{ $data->nextPageUrl() }}" class="text-blue-600 hover:underline">Selanjutnya →</a>
        @else
            <span class="text-gray-400">Selanjutnya →</span>
        @endif
    </div>
</div>
<!-- Modal -->
<div id="racikanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-md rounded shadow p-6 relative">
        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-600 text-2xl">&times;</button>
        <h3 class="text-lg font-semibold mb-3 text-blue-700">Detail Racikan</h3>
        <div id="modalContent" class="text-sm space-y-2">
            Loading...
        </div>
        <div class="mt-4 text-right">
            <a id="printButton" href="#" target="_blank"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
               Cetak Resep
            </a>
        </div>
    </div>
</div>


<script>
   function showDetail(id) {
    fetch(`/racikan/${id}`)
        .then(res => res.json())
        .then(data => {
            let html = `
                <p><strong>Nama Racikan:</strong> ${data.nama_racikan}</p>
                <p><strong>Signa:</strong> ${data.signa?.signa_nama ?? '-'}</p>
                <p class="font-medium mt-3">Obat dalam racikan:</p>
                <ul class="list-disc ml-5">`;

            data.details.forEach(detail => {
                html += `<li>${detail.obat?.obatalkes_nama ?? 'Obat Tidak Ditemukan'} (Qty: ${detail.qty})</li>`;
            });

            html += '</ul>';

            document.getElementById('modalContent').innerHTML = html;

            document.getElementById('printButton').href = `/racikan/${id}/cetak`;

            document.getElementById('racikanModal').classList.remove('hidden');
        });
}


    function closeModal() {
        document.getElementById('racikanModal').classList.add('hidden');
    }
</script>
@endsection
