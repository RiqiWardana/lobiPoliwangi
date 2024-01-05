<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @include('\font\poppins')
    <title>Preview Data Lomba | Lobi Poliwangi</title>
</head>
<body>
    <!-- Flexing Sidebar dan Body -->
    <div class="flex flex-row h-fit">
    <!-- Sidebar Admin -->
    @include('\admin\component\sidebar')
    <!-- Bagian Body -->
    <div class="pl-64 pr-4 pt-3 w-full h-full font-poppins">
        <!-- Sampul Gambar Beasiswa Preview -->
        <div class="w-full h-96 overflow-hidden relative">
            <div class="w-full h-full bg-black opacity-40 absolute z-10"></div>
            <img class="w-full bg-contain -translate-y-2/4 blur-sm" src="{{ asset('storage/' . $data->data_foto) }}">
        </div>
        <img class=" h-80 absolute z-10 top-[6%] left-2/4 border-8 border-slate-200 rounded-md" src="{{ asset('storage/' . $data->data_foto) }}">
        <!-- Bagian Informasi -->
        <div>
            <p class="text-3xl font-bold mt-10">{{ $data->nama_lomba }}</p>
            <p class="w-fit h-fit p-1.5 pl-4 pr-4 bg-blue-500 rounded-lg text-sm text-slate-100 font-medium">{{ $data->instansiLomba->nama_instansi_lomba }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-medium">Status Saat Ini</p>
            <p class="text-lg font-bold -mt-1 text-emerald-700">{{ $data->status->status }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-medium">Tanggal Penutupan Register</p>
            <p class="text-lg font-bold -mt-1">{{ $data->tanggal_penutupan }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-medium">Tingkatan Beasiswa</p>
            <p class="text-lg font-bold -mt-1">{{ $data->tingkatan->tingkatan }}</p>
        </div>
        <div class="mt-10">
            <p class="text-base font-semibold">Persyaratan Beasiswa</p>
            <p class="w-9/12 h-fit min-h-[150px] p-2 pl-3 pr-3 bg-slate-300 rounded-md text-sm font-normal">Data DB Belum Di tambah</p>
        </div>
        <div class="mt-4">
            <p class="text-base font-semibold">Link Pendaftaran Beasiswa</p>
            <p class="w-fit min-w-[75%] h-fit p-2 pl-3 pr-3 bg-slate-300 rounded-md text-sm font-normal">{{ $data->link_pendaftaran }}</p>
        </div>
        <p class="text-xl font-bold mt-10">Detail Lainnya</p>
        <div class="w-full h-[1px] bg-black mt-3"></div>
        <div></div>
        <div class="mt-6">
            <p class="text-sm font-semibold">Uploader</p>
            <p class="text-sm font-medium -mt-0.5">{{ $data->accountAdmin->username }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-semibold">Tanggal Upload</p>
            <p class="text-sm font-medium -mt-0.5">{{ $data->created_at }}</p>
        </div>
        <div class="mt-6">
            <p class="text-sm font-semibold">Tanggal Edit</p>
            <p class="text-sm font-medium -mt-0.5">{{ $data->updated_at }}</p>
        </div>
        <div class="w-5/12 flex flex-row mt-10 mb-10 justify-between">
            <a href="" class="w-fit h-fit flex p-3 bg-slate-300 rounded-md ">Kembali Ke Index</a>
            <a href="/dashboard-admin/index-data-lomba/edit-data/{{ $data->id }}" class="w-fit h-fit p-3 bg-slate-300 rounded cursor-pointer" type="submit">Edit Data Ini</a>
            <form action="/dashboard-admin/index-data-lomba/deleting-data/{{ $data->id }}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="idInstansiLomba" value="{{ $data->instansiLomba->id }}">
                <button class="w-fit h-fit p-3 bg-slate-300 rounded cursor-pointer" type="submit">Hapus Data</button>
            </form>
        </div>
    </div>
</body>
</html>