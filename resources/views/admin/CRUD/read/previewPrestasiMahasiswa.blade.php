<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @include('\font\poppins')
    <title>Preview Data Beasiswa | Lobi Poliwangi</title>
</head>
<body>
    <!-- Flexing Sidebar dan Body -->
    <div class="flex flex-row h-fit">
    <!-- Sidebar Admin -->
    @include('\admin\component\sidebar')
    <!-- Bagian Body -->
    <div class="pl-64 pr-4 pt-3 w-full h-full font-poppins">
        <!-- Bagian Informasi -->
        <div>
            <p class="text-3xl font-bold mt-10">{{ $dataPrestasi->nama_mahasiswa }}</p>
            <p class="w-fit h-fit p-1.5 pl-4 pr-4 bg-blue-500 rounded-lg text-sm text-slate-100 font-medium">{{ $dataPrestasi->nim }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-medium">Prodi</p>
            <p class="text-lg font-bold -mt-1">{{ $dataPrestasi->jurusan->prodi->nam_prodi }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-medium">Jurusan</p>
            <p class="text-lg font-bold -mt-1">{{ $dataPrestasi->jurusan->nama_jurusan }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-medium">Tingkatan Beasiswa</p>
            <p class="text-lg font-bold -mt-1">{{ $dataPrestasi->prestasi->tingkatan->tingkatan }}</p>
        </div>
        <div class="mt-4">
            <p class="text-base font-semibold">Nama Perlombaan</p>
            <p class="w-fit min-w-[75%] h-fit p-2 pl-3 pr-3 bg-slate-300 rounded-md text-sm font-normal">{{ $dataPrestasi->prestasi->nama_perlombaan_prestasi }}</p>
        </div>
        <div class="mt-4">
            <p class="text-base font-semibold">Prestasi</p>
            <p class="w-fit min-w-[75%] h-fit p-2 pl-3 pr-3 bg-slate-300 rounded-md text-sm font-normal">{{ $dataPrestasi->prestasi->nama_prestasi }}</p>
        </div>
        <p class="text-xl font-bold mt-10">Detail Lainnya</p>
        <div class="w-full h-[1px] bg-black mt-3"></div>
        <div></div>
        <div class="mt-6">
            <p class="text-sm font-semibold">Uploader</p>
            <p class="text-sm font-medium -mt-0.5">{{ $dataPrestasi->accountAdmin->username }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-semibold">Tanggal Upload</p>
            <p class="text-sm font-medium -mt-0.5">{{ $dataPrestasi->created_at }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-semibold">Tanggal Edit</p>
            <p class="text-sm font-medium -mt-0.5">{{ $dataPrestasi->updated_at }}</p>
        </div>
        <div class="w-6/12 flex flex-row mt-10 mb-10 justify-between">
            <a href="" class="w-fit h-fit flex p-3 bg-slate-300 rounded-md ">Kembali Ke Index</a>
            <a href="/dashboard-admin/index-data-prestasi-mahasiswa/edit-data/{{ $dataPrestasi->id }}" class="w-fit h-fit p-3 bg-slate-300 rounded cursor-pointer" type="submit">Edit Data Ini</a>
        </div>
    </div>
</body>
</html>