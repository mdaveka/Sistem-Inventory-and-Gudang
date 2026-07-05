<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Label QR Code</title>
    <!-- Tailwind CSS untuk styling Grid Kertas A4 -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- QRCode.js untuk menggambar QR Code -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        /* Pengaturan Kertas untuk Printer */
        @media print {
            @page { margin: 0.5cm; size: A4; }
            body { -webkit-print-color-adjust: exact; background-color: white; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gray-100 print:bg-white text-gray-800 font-sans" onload="setTimeout(() => window.print(), 500)">
    
    <!-- Tombol Kembali (Hanya tampil di layar komputer) -->
    <div class="no-print max-w-5xl mx-auto mt-8 mb-4 flex justify-between items-center px-4">
        <a href="{{ route('items.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 font-medium text-sm transition">
            &larr; Kembali ke Data Barang
        </a>
        <button onclick="window.print()" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-bold text-sm shadow-md transition">
            Print Sekarang
        </button>
    </div>

    <!-- Area Kertas Stiker (Kotak-kotak QR Code) -->
    <div class="max-w-5xl mx-auto p-4 print:p-0">
        <!-- Grid 4 kolom agar pas di kertas A4 & hemat kertas -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 print:gap-2">
            @foreach($items as $item)
            <div class="border-2 border-dashed border-gray-300 print:border-gray-400 p-4 flex flex-col items-center justify-center bg-white text-center rounded-xl h-44 page-break-inside-avoid">
                <p class="font-extrabold text-[13px] mb-2 uppercase truncate w-full text-gray-800 tracking-tight">{{ $item->name }}</p>
                
                <!-- Tempat QR Code dirender -->
                <div class="qr-print-render mb-2" data-value="{{ $item->barcode }}"></div>
                
                <!-- Kode teks di bawah QR -->
                <p class="text-xs font-mono font-bold text-gray-700 tracking-widest">{{ $item->barcode }}</p>
                <p class="text-[9px] text-gray-400 mt-1 font-semibold uppercase">
                    {{ $item->supplier->name ?? 'Gudang Internal' }}
                </p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Script Render QR Code -->
    <script>
        document.querySelectorAll('.qr-print-render').forEach(function(el) {
            new QRCode(el, {
                text: el.getAttribute('data-value'),
                width: 75, // Ukuran QR Code lebih besar untuk dicetak
                height: 75,
                colorDark : "#0f172a", // Navy sangat gelap
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.M // Level error correction medium
            });
        });
    </script>
</body>
</html>