<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @include('\font\poppins')
    <title>Index Data Lomba | Lobi Poliwangi</title>
</head>
<body>
    <!-- Flexing Sidebar dan Body -->
    <div class="flex flex-row h-fit">
    <!-- Sidebar Admin -->
    @include('\admin\component\sidebar')
    <!-- Bagian Body -->
    <div class="pl-64 pr-6 w-full h-full">
        <table class="table-auto border-2 font-poppins w-full">
            <thead>
                <tr>
                    <td class="bg-slate-300 font-semibold text-center">Foto Brosur</td>
                    <td class="bg-slate-300 font-semibold text-center">Nama Lomba</td>
                    <td class="bg-slate-300 font-semibold text-center">Nama Instansi</td>
                    <td class="bg-slate-300 font-semibold text-center">Tingkatan</td>
                    <td class="bg-slate-300 font-semibold text-center">Link Pendaftaran</td>
                    <td class="bg-slate-300 font-semibold text-center">Status</td>
                    <td class="bg-slate-300 font-semibold text-center">Uploader</td>
                    <td class="bg-slate-300 font-semibold text-center">Actions</td>
                </tr>
            </thead>
            <tbody>
                @if (empty($dataLombaAll))
                <tr>
                    <td rowspan="8"><center>Data Kosong</center></td>
                </tr>
                @else
                @foreach ($dataLombaAll as $data)
                <tr>
                    <td class="border flex justify-center">
                        <!-- Tampilan Index Foto Beasiswa -->
                        <img class="w- h-16" src="{{ asset('storage/' . $data->data_foto) }}">
                    </td>
                    <td class="border p-4">{{ $data->nama_lomba }}</td>
                    <td class="border p-4">{{ $data->instansiLomba->nama_instansi_lomba }}</td>
                    <td class="border p-4">{{ $data->tingkatan->tingkatan }}</td>
                    <td class="border p-4">{{ $data->link_pendaftaran }}</td>
                    <td class="border p-4">{{ $data->status->status }}</td>
                    <td class="border p-4">{{ $data->accountAdmin->username }}</td>
                    <td class="border p-2">
                        <div class="w-full h-full gap-4 flex flex-col justify-between items-center">
                            <a href="/dashboard-admin/index-data-lomba/preview/{{ $data->id }}" class="w-fit h-fit p-2 flex justify-center items-center bg-slate-200 rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-sm">Preview</a>
                            <form class="w-fit h-fit inline" action="/dashboard-admin/index-data-lomba/deleting-data/{{ $data->id }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="idInstansiLomba" value="{{ $data->instansiLomba->id }}">
                                <button class="w-fit -h-fit p-2 flex justify-center items-center bg-slate-200 rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-sm" type="submit">Hapus Data</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <!-- Tombol Tambah Data -->
        <a href="/dashboard-admin/tambah-data-lomba" class="w-16 h-16 bg-sky-300 absolute bottom-6 right-6 rounded-full cursor-pointer hover:w-48">
        </a>
    </div>
    </div>
    @if (session()->has('successAddedData'))
    <script>alert('{{ session("successAddedData") }}')</script>
    @endif
    @if (session()->has('dataSuccessDeleted'))
    <script>alert('{{ session("dataSuccessDeleted") }}')</script>
    @endif
</body>
</html>