@extends('layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 h-[calc(100vh-100px)]">
  
    <div class="bg-white shadow p-6 overflow-y-auto">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">Non Racikan</h2>
        <form method="POST" action="{{ url('/resep') }}">
            @csrf
            <div class="mb-4">
                <label class="text-sm text-gray-600 block mb-1">Obat</label>
                <select name="non_racikan[obatalkes_id]" class="w-full border p-2 rounded" required>
                    <option value="">-- pilih obat --</option>
                    @foreach ($obatList as $obat)
                        <option value="{{ $obat->obatalkes_id }}">{{ $obat->obatalkes_nama }} (Stok: {{ $obat->stok }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="text-sm text-gray-600 block mb-1">Qty</label>
                <input type="number" name="non_racikan[qty]" class="w-full border p-2 rounded" min="1" required>
            </div>

            <div class="mb-4">
                <label class="text-sm text-gray-600 block mb-1">Signa</label>
                <select name="non_racikan[signa_id]" class="w-full border p-2 rounded" required>
                    <option value="">-- pilih signa --</option>
                    @foreach ($signaList as $signa)
                        <option value="{{ $signa->signa_id }}">{{ $signa->signa_nama }}</option>
                    @endforeach
                </select>
            </div>

            <button name="submit_non_racikan" type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                Simpan Non Racikan
            </button>
        </form>
    </div>

    <div class="bg-white shadow p-6 overflow-y-auto">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">Racikan</h2>
        <form method="POST" action="{{ url('/resep') }}" id="racikan-form">
            @csrf

            <div class="mb-4">
                <label class="text-sm text-gray-600 block mb-1">Nama Racikan</label>
                <input type="text" name="racikan[nama]" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="text-sm text-gray-600 block mb-1">Signa Racikan</label>
                <select name="racikan[signa_id]" class="w-full border p-2 rounded" required>
                    <option value="">-- pilih signa --</option>
                    @foreach ($signaList as $signa)
                        <option value="{{ $signa->signa_id }}">{{ $signa->signa_nama }}</option>
                    @endforeach
                </select>
            </div>

            <div id="bahan-container" class="space-y-4">
                <div class="grid grid-cols-2 gap-4 bahan-row">
                    <div>
                        <label class="text-sm text-gray-600 block">Obat</label>
                        <select name="racikan[detail][0][obatalkes_id]" class="w-full border p-2 rounded" required>
                            <option value="">-- pilih obat --</option>
                            @foreach ($obatList as $obat)
                                <option value="{{ $obat->obatalkes_id }}">{{ $obat->obatalkes_nama }} (Stok: {{ $obat->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600 block">Qty</label>
                        <div class="flex gap-2 items-center">
                            <input type="number" name="racikan[detail][0][qty]" class="w-full border p-2 rounded" min="1" required>
                            <button type="button" class="text-red-600 text-sm remove-bahan hidden">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="button" onclick="addBahan()" class="text-blue-600 text-sm hover:underline">
                    + Tambah Obat
                </button>
            </div>

            <div class="mt-6">
                <button name="submit_racikan" type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                    Simpan Racikan
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    let bahanIndex = 1;

    function addBahan() {
        const container = document.getElementById('bahan-container');

        const div = document.createElement('div');
        div.classList.add('grid', 'grid-cols-2', 'gap-4', 'bahan-row');

        div.innerHTML = `
            <div>
                <label class="text-sm text-gray-600 block">Obat</label>
                <select name="racikan[detail][${bahanIndex}][obatalkes_id]" class="w-full border p-2 rounded" required>
                    <option value="">-- pilih obat --</option>
                    @foreach ($obatList as $obat)
                        <option value="{{ $obat->obatalkes_id }}">{{ $obat->obatalkes_nama }} (Stok: {{ $obat->stok }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600 block">Qty</label>
                <div class="flex gap-2 items-center">
                    <input type="number" name="racikan[detail][${bahanIndex}][qty]" class="w-full border p-2 rounded" min="1" required>
                    <button type="button" class="text-red-600 text-sm remove-bahan" onclick="removeBahan(this)">Hapus</button>
                </div>
            </div>
        `;

        container.appendChild(div);
        bahanIndex++;
    }

    function removeBahan(button) {
        const row = button.closest('.bahan-row');
        row.remove();
    }
</script>
@endsection
