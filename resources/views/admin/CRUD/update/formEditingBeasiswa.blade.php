<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @include('\font\poppins')
    <title>Index Data Beasiswa | Lobi Poliwangi</title>
</head>
<body>
    <!-- Flexing Sidebar dan Body -->
    <div class="flex flex-row h-fit">
    <!-- Sidebar Admin -->
    @include('\admin\component\sidebar')
    <!-- Bagian Body -->
    <div class="pl-64 pr-6 w-full h-full">
        <!-- Form Create Beasiswa -->
        <form class="font-poppins mt-4" action="/dashboard-admin/index-data-beasiswa/edit-data/{{ $data->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="flex flex-row justify-between w-8/12">
                <div>
                    <label class="text-sm font-medium text-black">Nama Beasiswa</label><br>
                    <input class="w-80 outline-0 border-[1px] rounded-md border-black pl-2 pr-2 text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" type="text" name="namaBeasiswa" placeholder="Masukan Nama Beasiswa" value="{{ $data->nama_beasiswa }}">
                </div>
                <div class="mr-12">
                    <label class="text-sm font-medium text-black">Nama Instansi</label><br>
                    <input class="w-64 outline-0 border-[1px] rounded-md border-black pl-2 pr-2 text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" type="text" name="namaInstansi" placeholder="Masukan Nama Instansi Etc. PT. Sumber Makmr" value="{{ $data->instansiBeasiswa->nama_instansi_beasiswa }}">
                </div>
            </div>
            <div class="mr-12 mt-4">
                <label class="text-sm font-medium text-black">Persyaratan Beasiswa</label><br>
                <textarea class="text-xs outline-0 border-2 rounded=lg border=black pl-2 pr-2 text-xs leading-8" name="persyaratan" id="" cols="100" rows="5">{{ $data->persyaratan }}</textarea>
            </div>
            <div class="mr-12 mt-4">
                <label class="text-sm font-medium text-black">Link Pendaftaran</label><br>
                <input class="w-96 outline-0 border-[1px] rounded-md border-black pl-2 pr-2 text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" type="text" name="linkPendaftaran" placeholder="Masukan Link Pendaftaran" value="{{ $data->link_pendaftaran }}">
            </div>
            <div class="flex flex-row">
                <div class="mr-12 mt-4">
                    <label class="text-sm font-medium text-black">Tanggal Terakhir Pendaftaran</label><br>
                    <input class="w-64 mt-2 bg-sky-500 outline-0 border-0 rounded-md border-black pl-2 pr-2 text-white text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" type="date" name="tanggalPenutupan" placeholder="Masukan Nama Instansi Etc. PT. Sumber Makmr" value="{{ $data->tanggal_penutupan }}">
                </div>
                <div class="mr-12 mt-4">
                    <label class="text-sm font-medium text-black">Masukan Tingkatan Beasiswa</label><br>
                    <select class="w-64 mt-2 p-2 bg-sky-500 outline-0 border-0 rounded-md border-black pl-2 pr-2 text-white text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" name="tingkatanBeasiswa">
                        @foreach($dataTingkatan as $dataTingkatan)
                            <option value="{{ $dataTingkatan->id }}" @if($dataTingkatan->id == $data->tingkatan->id) selected @endif>{{ $dataTingkatan->tingkatan }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="mr-12 mt-4">
                <label class="text-sm font-medium text-black">Foto Brosur Beasiswa</label><br>
                <input class="w-64 mt-2 bg-sky-500 outline-0 border-0 rounded-md pl-2 pr-2 text-white text-xs leading-8 placeholder:text-xs placeholder:font-extralight placeholder:italic" type="file" name="dataFotoTerbaru" value="{{ $data->data_foto }}">
                <img class="w-2/6 my-6" src="{{ asset('storage/' . $data->data_foto) }}">
            </div>
            <input type="hidden" name="idInstansiOldBeasiswa" value="{{ $data->instansiBeasiswa->id }}">
            <input type="hidden" name="dataFotoLama" value="{{ $data->data_foto }}">
            <button class="w-80 p-2 mt-4 text-white text-base font-normal bg-sky-500 border-0 rounded-md" type="submit">Edit Data</button>
        </form>
    </div>
    </div>
</body>
</html>