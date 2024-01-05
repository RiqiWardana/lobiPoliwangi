<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


// Import Table //
use App\Models\beasiswa;
use App\Models\lomba;
use App\Models\tingkatan;
use App\Models\mahasiswa_prestasi;
use App\Models\jurusan;
use App\Models\account_admin;

class adminController extends Controller
{
    // Menampilkan Dashboard Admin //
    public function indexDashboard()
    {
        return view('\admin\dashboard');
    }
    // Index Data Table Beasiswa //
    public function indexTableBeasiswa()
    {
        $dataBeasiswaAll = beasiswa::all();
        if (empty($dataBeasiswaAll)) {
            $dataBeasiswaAll = null;
        }
        return view('\admin\indexData\beasiswaIndexData', [
            'dataBeasiswaAll' => $dataBeasiswaAll,
        ]);
    }
    // Index Data Table Lomba //
    public function indexTableLomba()
    {
        $dataLombaAll = lomba::all();
        if (empty($dataLombaAll)) {
            $dataLombaAll = null;
        }
        return view('\admin\indexData\lombaIndexData', [
            'dataLombaAll' => $dataLombaAll,
        ]);
    }
    // Index Data Table Prestasi Yang Di Dapatkan Mahasiswa //
    public function indexTablePrestasi()
    {
        $dataPrestasiAll = mahasiswa_prestasi::all();
        if (empty($dataPrestasiAll)) {
            $dataPrestasiAll = null;
        }
        return view('\admin\indexData\prestasiMahasiswaIndexData', [
            'dataPrestasiAll' => $dataPrestasiAll,
        ]);
    }
    // Index Data Table Mahasiswa //
    public function indexTableMahasiswa()
    {
        $getApiMahasiswa = new Client();
        $urlApi = 'http://127.0.0.1:8000/api/get-all-data-mahasiswa';
        $responseMahasiswa = $getApiMahasiswa->request('GET', $urlApi);
        $contentMahasiswa = $responseMahasiswa->getBody()->getContents();
        $contentArrayMahasiswa = json_decode($contentMahasiswa, true);
        $dataMahasiswa =  $contentArrayMahasiswa['data'];
        return view('\admin\indexData\daftarMahasiswaIndexData', [
            'dataMahasiswaAll' => $dataMahasiswa,
        ]);
    }
    // Halaman Tambah Data Beasiswa //
    public function formTambahDataBeasiswa()
    {
        return view('\admin\CRUD\create\formCreateBeasiswa');
    }
    // Halaman Tambah Data Lomba //
    public function formTambahDataLomba()
    {
        return view('\admin\CRUD\create\formCreateLomba');
    }
    // Halaman Tambah Data Prestasi //
    public function formTambahDataPrestasi()
    {
        $getApiJurusan = new Client();
        $urlApi = 'http://127.0.0.1:8000/api/get-data-jurusan-all';
        $responseJurusan = $getApiJurusan->request('GET', $urlApi);
        $contentJurusan = $responseJurusan->getBody()->getContents();
        $contentArrayJurusan = json_decode($contentJurusan, true);
        $dataJurusan =  $contentArrayJurusan['data'];
        return view('\admin\CRUD\create\formCreatePrestasiMahasiswa', [
            'dataJurusan' => $dataJurusan,
        ]);
    }
    // Halaman Mengedit Data Beasiswa //
    public function formEditingDataBeasiswa(beasiswa $beasiswa)
    {
        $dataBeasiswa = beasiswa::where('id', $beasiswa->id)->first();
        $dataTingkatanBeasiswa = tingkatan::all();
        return view('\admin\CRUD\update\formEditingBeasiswa', [
            'data' => $dataBeasiswa,
            'dataTingkatan' => $dataTingkatanBeasiswa,
        ]);
    }
    // Halaman Mengedit Data Lomba //
    public function formEditingDataLomba(lomba $lomba)
    {
        $dataLomba = lomba::where('id', $lomba->id)->first();
        $dataTingkatanLomba = tingkatan::all();
        return view('\admin\CRUD\update\formEditingLomba', [
            'data' => $dataLomba,
            'dataTingkatan' => $dataTingkatanLomba,
        ]);
    }
    // Halaman Mengedit Data Prestasi //
    public function formEditingDataPrestasi(mahasiswa_prestasi $mahasiswa_prestasi)
    {
        $dataPrestasi = mahasiswa_prestasi::where('id', $mahasiswa_prestasi->id)->first();
        $dataTingkatanPrestasi = tingkatan::all();
        return view('\admin\CRUD\update\formEditingPrestasiMahasiswa', [
            'data' => $dataPrestasi,
            'dataTingkatan' => $dataTingkatanPrestasi,
        ]);
    }
    // Halaman Profil Admin //
    public function profileAdmin()
    {
        $dataAccount = account_admin::where('username', auth('userAdmin')->user()->username)->first();
        return view('\admin\auth\profilPageAdmin', [
            'dataAccount' => $dataAccount,
        ]);
    }
}
