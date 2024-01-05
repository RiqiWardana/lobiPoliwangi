<?php

namespace App\Http\Controllers\web\dataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Auth Library Import //
use Illuminate\Support\Facades\Auth;

// Storage Library //
use Illuminate\Support\Facades\Storage;

// Import Model Table //
use App\Models\instansi_lomba;
use App\Models\lomba;

class lombaController extends Controller
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
            'namaLomba' => ['required', 'max:255'],
            'namaInstansi' => ['required', 'max:255'],
            'persyaratan' => ['required', 'max:255'],
            'linkPendaftaran' => ['required', 'max:255'],
            'tanggalPendaftaranTerakhir' => ['required'],
            'tingkatan' => ['required'],
            'dataFoto' => ['required', 'image', 'file'],
        ]);
        // Ambil Data User Admin Di Auth //
        $validateData['accountAdmin']=auth('userAdmin')->user()->id;
        // Menaruh File Di Local Storage //
        $validateData['dataFoto']=$request->file('dataFoto')->store('lombaDataImg');
        
        // Memfilter Id Instansi Di Table Instansi //
        $idInstansi = instansi_lomba::firstOrCreate([
            'nama_instansi_lomba' => $validateData['namaInstansi']
        ]);
        
        // Membuat Data Beasiswa Ke Model //
        lomba::create ([
            'nama_lomba' => $validateData['namaLomba'],
            'instansi_lomba_id' => $idInstansi->id,
            'link_pendaftaran' => $validateData['linkPendaftaran'],
            'persyaratan' => $validateData['persyaratan'],
            'tanggal_penutupan' => $validateData['tanggalPendaftaranTerakhir'],
            'tingkatan_id' => $validateData['tingkatan'],
            'account_admin_id' => $validateData['accountAdmin'],
            'data_foto' => $validateData['dataFoto'],
            'status_id' => '1',
        ]);

        return redirect()->route('indexTableDataLomba')->with('successAddedData', 'Data Berhasil Di Tambahkan');
    }

    // Menampilkan 1 Data (Preview Data) //
    public function show(lomba $lomba)
    {
        // Mengambil Data Dari Database Menurut Model Binding //
        $dataLomba = lomba::where('id', $lomba->id)->first();
        return view('\admin\CRUD\read\previewLomba', [
            'data' => $dataLomba,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    // Mengupdate Data Lomba Dalam Table Database //
    public function update(lomba $lomba, Request $request)
    {
        // Validasi Form Update //
        $validateData = $request->validate([
            'namaLomba' => ['required', 'max:255'],
            'namaInstansi' => ['required', 'max:255'],
            'persyaratan' => ['required', 'max:255'],
            'linkPendaftaran' => ['required', 'max:255'],
            'tanggalPendaftaranTerakhir' => ['required'],
            'tingkatan' => ['required'],
        ]);
        // Ambil Data User Admin Di Auth //
        $validateData['accountAdmin']=auth('userAdmin')->user()->id;
        //Validasi Link Pendaftaran Karena Di Database Unique //
        $validateData['linkPendaftaran']=$request->linkPendaftaran;
        
        // Mengambil Data Instansi Dari Database //
        $idInstansi = instansi_lomba::firstOrCreate([
            'nama_instansi_lomba' => $validateData['namaInstansi']
        ]);

        // Mengambil Data Dari Database Yang Akan Di Update //
        $wantEditing = lomba::find($lomba->id);
        // Proses Update Data Databases //
        
        if ($request->file('dataFotoTerbaru'))
        {
            // Mengupdate Data Foto Beserta Menentukan Validasi Request //
            Storage::delete($request->dataFotoLama);
            $validateData['dataFotoTerbaru'] = $request->file('dataFotoTerbaru')->store('lombaDataImg');
            $wantEditing->update([
                'data_foto' => $validateData['dataFotoTerbaru']
            ]);
        }
        // Proses Update Data Tanpa Data Foto //
        $wantEditing->update([
            'nama_lomba' => $validateData['namaLomba'],
            'instansi_lomba_id' => $idInstansi->id,
            'link_pendaftaran' => $validateData['linkPendaftaran'],
            'persyaratan' => $validateData['persyaratan'],
            'tanggal_penutupan' => $validateData['tanggalPendaftaranTerakhir'],
            'tingkatan_id' => $validateData['tingkatan'],
            'account_admin_id' => $validateData['accountAdmin'],
            'status_id' => '1',
        ]);
        $idInstansiOld = instansi_lomba::where('id', $request->idInstansiOldLomba)->get();
        if (empty($idInstansiOld->lomba)) {
            instansi_lomba::destroy($request->idInstansiOldLomba);
            return redirect()->intended('/dashboard-admin/index-data-lomba/preview/' . $wantEditing->id)->with('dataSuccessUpdated','Data Telah Sukses Di Update');
        } 
        else 
        {
            return redirect()->intended('/dashboard-admin/index-data-lomba/preview/' . $wantEditing->id)->with('dataSuccessUpdated','Data Telah Sukses Di Update');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lomba $lomba, Request $request)
    {
        // Mengambil Data Yang cocok Berdasarkan Route BInding DI database ??
        $idInstansiUseless = instansi_lomba::where('id', $lomba->instansi_lomba_id)->get();
        // Menghapus Data Public Di Link Storage //
        Storage::delete($lomba->data_foto);
        // Menghapus Data Pada Table //
        lomba::destroy($lomba->id);
        // Mengecek Relasi Dengan Table Instansi //
        if (empty($id_instansi_useless->lomba)) {
            instansi_lomba::destroy($request->idInstansiLomba);
        };
        return redirect()->route('indexTableDataLomba')->with('dataSuccessDeleted','Data Telah Sukses Di Hapus');
    }
}
