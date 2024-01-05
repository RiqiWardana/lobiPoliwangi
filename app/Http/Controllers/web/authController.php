<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    // Halaman Login Untuk Admin //
    public function pageLoginForAdmin() {
        return view ('\admin\auth\loginPage');
    }

    // Mengecek Kredensial Login Untuk Admin //
    public function authentikasiUserAdmin(Request $request) {

        // Validasi Request Form //
        $kredensialAdmin = $request->validate([
            'username' => ['required', 'max:255'],
            'password' => ['required', 'max:255'],
        ]);
        
        // Mengecek Kredensial Dari Tabel Admin Untuk Attemp Session Login //
        if(Auth::guard('userAdmin')->attempt($kredensialAdmin)) {
            $request-> session()->regenerate();
            return redirect()->intended('/dashboard-admin');
        }
        else {

            // Pesan Error Dalam Authentikasi Serta Redirect Kembali Ke Page Login //
            return back()->with('authGagal', 'Login Gagal, Silahkan Coba Lagi.');
        }
    }
    public function logoutAccount() 
    {
        auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect(route('loginAdmin'))->with('messageLogout', 'Anda Telah berhasil Log Out');
    }
}
