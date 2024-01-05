<?php

namespace App\Http\Controllers\web\dataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

// Import Table Database //
use App\Models\prodi;
use App\Models\jurusan;
use App\Models\prestasi;
use App\Models\mahasiswa_prestasi;


class prestasiModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // Menambahkan Data Baru Ke Dalam Table Di Database //
    public function store(Request $request)
    {
        //Validasi Form Tambah Data //
        $validate_data = $request->validate([
            'nim' => ['required', 'max:255'],
            'namaPerlombaan' => ['required', 'max:255'],
            'prestasi' => ['required', 'max:255'],
            'tingkatan' => ['required', 'max:255'],
        ]);
        // Ambil Data User Admin Di Auth //
        $validateData['accountAdmin']=auth('userAdmin')->user()->id;

        // Get Api Mahasiswa Berdasarkan NIM //
        $getApiMahasiswa = new Client();
        $urlApi = 'http://127.0.0.1:8000/api/get-data-mahasiswa/' . $validate_data['nim'];
        $responseMahasiswa = $getApiMahasiswa->request('GET', $urlApi);
        $contentMahasiswa = $responseMahasiswa->getBody()->getContents();
        $contentArrayMahasiswa = json_decode($contentMahasiswa, true);
        $dataMahasiswa =  $contentArrayMahasiswa['data'];

        // Mengecek Ke Api Apakah ada Datanya //
        if (!empty($dataMahasiswa)) {
            $dataMahasiswa =  $contentArrayMahasiswa['data'][0];
            $prodiId = prodi::firstOrCreate([
                'nama_prodi' => $dataMahasiswa['jurusan']['prodi']['nama_prodi'],
            ]);
            $jurusanId = jurusan::firstOrCreate([
                'nama_jurusan' => $dataMahasiswa['jurusan']['nama_jurusan'],
                'prodi_id' => $prodiId->id,
            ]);
            $prestasiId = prestasi::firstOrCreate([
                'nama_perlombaan_prestasi' => $validate_data['namaPerlombaan'],
                'nama_prestasi' => $validate_data['prestasi'],
                'tingkatan_id' => $validate_data['tingkatan'],
            ]);
            mahasiswa_prestasi::create([
                'nim' =>  $dataMahasiswa['nim'],
                'nama_mahasiswa' => $dataMahasiswa['nama_mahasiswa'],
                'jurusan_id' => $jurusanId->id,
                'prestasi_id' => $prestasiId->id,
                'account_admin_id' => $validateData['accountAdmin'],
            ]);
            return redirect(route('indexTableDataPrestasi'));
        } else {
            return back()->with('wrongCredentials', 'Kredensial Mahasiswa Salah Harap Periksa lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($nim)
    {   
        $dataPrestasi = mahasiswa_prestasi::where('nim', $nim)->first();
        if (empty($dataPrestasi)) {
            $dataPrestasi = null;
        }
        return view ('\admin\CRUD\read\previewPrestasiMahasiswa', [
            'dataPrestasi' => $dataPrestasi,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(mahasiswa_prestasi $mahasiswa_prestasi, Request $request)
    {
        $validateData = $request->validate([
            'nim' => ['required', 'max:255'],
            'namaPerlombaan' => ['required', 'max:255'],
            'prestasi' => ['required', 'max:255'],
            'tingkatan' => ['required', 'max:255'],
        ]);
        // Ambil Data User Admin Di Auth //
        $validateData['accountAdmin']=auth('userAdmin')->user()->id;

        // Mengambil ID Foreign //
        $getApiMahasiswa = new Client();
        $urlApi = 'http://127.0.0.1:8000/api/get-data-mahasiswa/' . $validateData['nim'];
        $responseMahasiswa = $getApiMahasiswa->request('GET', $urlApi);
        $contentMahasiswa = $responseMahasiswa->getBody()->getContents();
        $contentArrayMahasiswa = json_decode($contentMahasiswa, true);
        $dataMahasiswa =  $contentArrayMahasiswa['data'][0];
        
        $idPrestasiOld = prestasi::where('id', $request->idPrestasiOld)->get();
        $idJurusanOld = jurusan::where('id', $request->idJurusanOld)->get();
        $idProdiOld = prodi::where('nama_prodi', $request->idProdiOld)->get();
        $idPrestasiOld = prestasi::where('id', $request->idPrestasiOld)->first();
        $idJurusanOld = jurusan::where('id', $request->idJurusanOld)->first();
        $idProdiOld = prodi::where('nama_prodi', $request->idProdiOld)->first();
        
        $wantUpdating = mahasiswa_prestasi::find($mahasiswa_prestasi->id);

        $prestasiId = prestasi::firstOrCreate([
            'nama_perlombaan_prestasi' => $validateData['namaPerlombaan'],
            'nama_prestasi' => $validateData['prestasi'],
            'tingkatan_id' => $validateData['tingkatan'],
        ]);

        $prodiId = prodi::firstOrCreate([
            'nama_prodi' => $dataMahasiswa['jurusan']['prodi']['nama_prodi'],
        ]);

        $jurusanId = jurusan::firstOrCreate([
            'nama_jurusan' => $dataMahasiswa['jurusan']['nama_jurusan'],
            'prodi_id' => $prodiId->id,
        ]);

        $wantUpdating->update([
            'nim' => $dataMahasiswa['nim'],
            'nama_mahasiswa' => $dataMahasiswa['nama_mahasiswa'],
            'jurusan_id' => $jurusanId->id,
            'prestasi_id' => $prestasiId->id,
            'account_admin_id' => $validateData['accountAdmin'],
        ]);

        if(!$idPrestasiOld->mahasiswaPrestasi) {
            prestasi::destroy($idPrestasiOld->id);
        };
        if(!$idProdiOld->jurusan) {
            prodi::destroy($idPrestasiOld);
            if (!$idJurusanOld->mahasiswaPrestasi) {
                jurusan::destroy($idPrestasiOld);
            }
        };
        if(!$idPrestasiOld->mahasiswaPrestasi) {
            prestasi::destroy($idPrestasiOld->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
