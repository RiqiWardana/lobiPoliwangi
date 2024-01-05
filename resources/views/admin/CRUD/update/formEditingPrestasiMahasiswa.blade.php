<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @include('\font\poppins')
    <title>Form Tambah Data Lomba | Lobi Poliwangi</title>
</head>
<body>  
    <!-- Flexing Sidebar dan Body -->
    <div class="flex flex-row h-fit">
    <!-- Sidebar Admin -->
    @include('\admin\component\sidebar')
    <!-- Bagian Body -->
    <div class="pl-64 pr-6 w-full h-full">
        <!-- Form Create Beasiswa -->
        <form class="font-poppins mt-4" action="/dashboard-admin/index-data-prestasi-mahasiswa/edit-data/{{ $data->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-row">
                <div class="mr-12">
                    <label class="text-sm font-medium text-black">Nama Mahasiswa</label><br>
                    <input class="w-80 outline-0 border-[1px] rounded-md border-black pl-2 pr-2 text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" type="text" name="namaMahasiswa" placeholder="Masukan Nama Beasiswa" value="{{ $data->nama_mahasiswa }}">
                </div>
                <div class="mr-12">
                    <label class="text-sm font-medium text-black">Nim Mahasiswa</label><br>
                    <input class="w-64 outline-0 border-[1px] rounded-md border-black pl-2 pr-2 text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" type="text" name="nim" placeholder="Masukan Nama Instansi Etc. PT. Sumber Makmur" value="{{ $data->nim }}">
                </div>
            </div>
            <div class="mr-12 mt-4">
                <label class="text-sm font-medium text-black">Nama Perlombaan Yang Di Ikuti</label><br>
                <input class="w-64 outline-0 border-[1px] rounded-md border-black pl-2 pr-2 text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" type="text" name="namaPerlombaan" placeholder="Masukan Nama Instansi Etc. PT. Sumber Makmur" value="{{ $data->prestasi->nama_perlombaan_prestasi }}">
            </div>
            <div class="mr-12 mt-4">
                <label class="text-sm font-medium text-black">Ranking/Posisi Dalam Perlombaan</label><br>
                <input class="w-64 outline-0 border-[1px] rounded-md border-black pl-2 pr-2 text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" type="text" name="prestasi" placeholder="Masukan Nama Instansi Etc. PT. Sumber Makmur" value="{{ $data->prestasi->nama_prestasi }}">
            </div>
            <div class="mr-12 mt-4">
                <label class="text-sm font-medium text-black">Tingkatan Perlombaan</label><br>
                <select class="w-64 mt-2 p-2 bg-sky-500 outline-0 border-0 rounded-md border-black pl-2 pr-2 text-white text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" name="tingkatan">
                    @foreach($dataTingkatan as $dataTingkatan)
                        <option value="{{ $dataTingkatan->id }}" @if($dataTingkatan->id == $data->prestasi->tingkatan->id) selected @endif>{{ $dataTingkatan->tingkatan }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="idPrestasiOld" value="{{ $data->prestasi_id }}">
            <input type="hidden" name="idJurusanOld" value="{{ $data->jurusan_id }}">
            <input type="hidden" name="idProdiOld" value="{{ $data->jurusan->prodi->nama_prodi }}">
            <button class="w-80 p-2 mt-4 text-white text-base font-normal bg-sky-500 border-0 rounded-md" type="submit">Tambahkan Data</button>
        </form>
    </div>
    </div>
</body>
</html>