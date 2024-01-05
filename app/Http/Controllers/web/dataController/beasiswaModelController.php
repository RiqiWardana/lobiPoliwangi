<?php

namespace App\Http\Controllers\web\dataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Auth Library Import //
use Illuminate\Support\Facades\Auth;

// Storage Library //
use Illuminate\Support\Facades\Storage;

// Import Model Table //
use App\Models\instansi_beasiswa;
use App\Models\beasiswa;

class beasiswaModelController extends Controller
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

    // Function Menambahkan Data Ke Database //
    public function store(Request $request)
    {
        // Validasi Form Pengisian //
        $validateData = $request->validate([
            'namaBeasiswa' => ['required', 'max:255'],
            'namaInstansi' => ['required', 'max:255'],
            'persyaratanBeasiswa' => ['required', 'max:255'],
            'linkPendaftaran' => ['required', 'max:255'],
            'tanggalPendaftaranBeasiswa' => ['required'],
            'tingkatanBeasiswa' => ['required'],
        ]);
        // Ambil Data User Admin Di Auth //
        $validateData['accountAdmin']=auth('userAdmin')->user()->id;
        // Menaruh File Di Local Storage //
        $validateData['fotoBrosurBeasiswa']=$request->file('fotoBrosurBeasiswa')->store('beasiswaDataImg');

        // Memfilter Id Instansi Di Table Instansi //
        $idInstansi = instansi_beasiswa::firstOrCreate([
            'nama_instansi_beasiswa' => $validateData['namaInstansi'],
        ]);
        
        // Membuat Data Beasiswa Ke Model //
        beasiswa::create ([
            'nama_beasiswa' => $validateData['namaBeasiswa'],
            'instansi_beasiswa_id' => $idInstansi->id,
            'link_pendaftaran' => $validateData['linkPendaftaran'],
            'persyaratan' => $validateData['persyaratanBeasiswa'],
            'tanggal_penutupan' => $validateData['tanggalPendaftaranBeasiswa'],
            'tingkatan_id' => $validateData['tingkatanBeasiswa'],
            'account_admin_id' => $validateData['accountAdmin'],
            'data_foto' => $validateData['fotoBrosurBeasiswa'],
            'status_id' => '1',
        ]);

        return redirect()->route('indexTableDataBeasiswa')->with('successAddedData', 'Data Berhasil Di Tambahkan');
    }

    // Menampilkan 1 Data (Preview Data) //
    public function show(beasiswa $beasiswa, Request $request)
    {
        // Mengambil Data Dari Database Menurut Model Binding //
        $dataBeasiswa = beasiswa::where('id', $beasiswa->id)->first();
        return view('\admin\CRUD\read\previewBeasiswa', [
            'data' => $dataBeasiswa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    // Untuk Mengupdate Data Terbaru Yang Telah Dipilih //
    public function update(beasiswa $beasiswa, Request $request)
    {
        $validateData = $request->validate([
            'namaBeasiswa' => ['required', 'max:255'],
            'namaInstansi' => ['required', 'max:255'],
            'persyaratan' => ['required', 'max:255'],
            'linkPendaftaran' => ['required', 'max:255'],
            'tanggalPenutupan' => ['required'],
            'tingkatanBeasiswa' => ['required'],
        ]);
        // Ambil Data User Admin Di Auth //
        $validateData['accountAdmin']=auth('userAdmin')->user()->id;
        //Validasi Link Pendaftaran Karena Di Database Unique //
        $validateData['linkPendaftaran']=$request->linkPendaftaran;

        // Mengambil Data Instansi Dari Database //
        $idInstansi = instansi_beasiswa::firstOrCreate([
            'nama_instansi_beasiswa' => $validateData['namaInstansi']
        ]);

        // Mengambil Data Dari Database Yang Akan Di Update //
        $wantEditing = beasiswa::find($beasiswa->id);
        // Proses Update Data Databases //
        
        if ($request->file('dataFotoTerbaru'))
        {
            // Mengupdate Data Foto Beserta Menentukan Validasi Request //
            Storage::delete($request->dataFotoLama);
            $validateData['dataFotoTerbaru'] = $request->file('dataFotoTerbaru')->store('beasiswaDataImg');
            $wantEditing->update([
                'data_foto' => $validateData['dataFotoTerbaru']
            ]);
        }
        // Proses Update Data Tanpa Data Foto //
        $wantEditing->update([
            'nama_beasiswa' => $validateData['namaBeasiswa'],
            'instansi_beasiswa_id' => $idInstansi->id,
            'link_pendaftaran' => $validateData['linkPendaftaran'],
            'persyaratan' => $validateData['persyaratan'],
            'tanggal_penutupan' => $validateData['tanggalPenutupan'],
            'tingkatan_id' => $validateData['tingkatanBeasiswa'],
            'account_admin_id' => $validateData['accountAdmin'],
            'status_id' => '1',
        ]);
        $idInstansiOld = instansi_beasiswa::where('id', $request->idInstansiOldBeasiswa)->get();
        if (empty($idInstansiOld->beasiswa)) {
            instansi_beasiswa::destroy($request->idInstansiOldBeasiswa);
            return redirect()->intended('/dashboard-admin/index-data-beasiswa/preview/' . $wantEditing->id)->with('dataSuccessUpdated','Data Telah Sukses Di Update');
        } 
        else 
        {
            return redirect()->intended('/dashboard-admin/index-data-beasiswa/preview/' . $wantEditing->id)->with('dataSuccessUpdated','Data Telah Sukses Di Update');

        }

    }

    // Function Untuk Menghpus Data Dalam Table Beasiswa //
    public function destroy(beasiswa $beasiswa, Request $request)
    {
        // Mengambil Data Yang cocok Berdasarkan Route BInding DI database ??
        $idInstansiUseless = instansi_beasiswa::where('id', $beasiswa->instansi_beasiswa_id)->get();
        // Menghapus Data Public Di Link Storage //
        Storage::delete($beasiswa->data_foto);
        // Menghapus Data Pada Table //
        beasiswa::destroy($beasiswa->id);
        // MEngecek Relasi Dengan Table Instansi //
        if (empty($id_instansi_useless->beasiswa)) {
            instansi_beasiswa::destroy($request->idInstansiBeasiswa);
        };
        return redirect()->route('indexTableDataBeasiswa')->with('dataSuccessDeleted','Data Telah Sukses Di Hapus');
    }
}
