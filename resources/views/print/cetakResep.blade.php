<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Resep Racikan</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="p-10">
    <h2 class="text-2xl font-bold mb-4">Resep Racikan: {{ $racikan->nama_racikan }}</h2>
    <p><strong>Signa:</strong> {{ $racikan->signa->signa_nama ?? '-' }}</p>

    <h3 class="mt-6 font-semibold">Detail Obat:</h3>
    <ul class="list-disc ml-6 mt-2">
        @foreach ($racikan->details as $detail)
            <li>{{ $detail->obat->obatalkes_nama ?? '-' }} (Qty: {{ $detail->qty }})</li>
        @endforeach
    </ul>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
