<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Tables Import //
use App\Models\account_admin;
use App\Models\beasiswa;
use App\Models\instansi_beasiswa;
use App\Models\lomba;
use App\Models\instansi_lomba;
use App\Models\status;
use App\Models\tingkatan;
use App\Models\prestasi;
use App\Models\mahasiswa_prestasi;
use App\Models\prodi;
use App\Models\jurusan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder Account Admin //
        account_admin::create([
            'username' => 'Kageyama',
            'password' => 'ujicoba',
        ]);
        // Seeder Status //
        status::create([
            'status' => 'Aktif',
        ]);
        status::create([
            'status' => 'Nonaktif',
        ]);

        // Seeder Tingkatan //
        tingkatan::create([
            'tingkatan' => 'Lokal',
        ]);
        tingkatan::create([
            'tingkatan' => 'Internasional',
        ]);

        // Seeder Instansi Beasiswa //
        instansi_beasiswa::create([
            'nama_instansi_beasiswa' => 'PT. Anyamonetes',
        ]);
        instansi_beasiswa::create([
            'nama_instansi_beasiswa' => 'PT. Djarum',
        ]);

        // Seeder Beasiswa //
        beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Japan',
            'instansi_beasiswa_id' => 1,
            'link_pendaftaran' => 'http://www.registerGratisBeasiswa.com',
            'data_foto' => 'beasiswaDataImg\pDQvgn3u5AOd25lv9S2BszhdDZtaQct0k1QYG5Xs.jpg',
            'persyaratan' => 'Minimal Ipk di atas 3.5',
            'tanggal_penutupan' => '2023-12-09',
            'tingkatan_id' => 1,
            'status_id' => 1,   
            'account_admin_id' => 1,
        ]);
        beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Korea',
            'instansi_beasiswa_id' => 2,
            'link_pendaftaran' => 'http://www.registerGratisBeasiswa.com',
            'data_foto' => 'beasiswaDataImg\pDQvgn3u5AOd25lv9S2BszhdDZtaQct0k1QYG5Xs.jpg',
            'persyaratan' => 'Minimal Semester 5',
            'tanggal_penutupan' => '2023-12-20',
            'tingkatan_id' => 2,
            'status_id' => 2,   
            'account_admin_id' => 1,
        ]);

        // Seeder Instansi Lomba //
        instansi_lomba::create([
            'nama_instansi_lomba' => 'PT. Animon',
        ]);
        instansi_lomba::create([
            'nama_instansi_lomba' => 'PT.Bighit',
        ]);

        // Seeder Lomba //
        lomba::create([
            'nama_lomba' => 'Lomba Puisi',
            'instansi_lomba_id' => 1,
            'link_pendaftaran' => 'http://www.registerGratisLomba.com',
            'data_foto' => 'beasiswaDataImg\pDQvgn3u5AOd25lv9S2BszhdDZtaQct0k1QYG5Xs.jpg',
            'persyaratan' => 'Minimal Ipk di atas 3.5',
            'tanggal_penutupan' => '2023-12-10',
            'tingkatan_id' => 1,
            'status_id' => 1,  
            'account_admin_id' => 1,
        ]);
        lomba::create([
            'nama_lomba' => 'Poliwangi National Writing National',
            'instansi_lomba_id' => 2,
            'link_pendaftaran' => 'http://www.registerGratisLomba2.com',
            'data_foto' => 'beasiswaDataImg\pDQvgn3u5AOd25lv9S2BszhdDZtaQct0k1QYG5Xs.jpg',
            'persyaratan' => 'Peserta harus bertim 3 orang',
            'tanggal_penutupan' => '2023-12-22',
            'tingkatan_id' => 2,
            'status_id' => 2,  
            'account_admin_id' => 1,
        ]);

        // Seeder Prodi //
        prodi::create([
            'nama_prodi' => 'Teknologi Rekaya Perangkat Lunak',
        ]);
        prodi::create([
            'nama_prodi' => 'Agribisnis',
        ]);


        // Seeder Jurusan //
        jurusan::create([
            'nama_jurusan' => 'Bisnis dan Informatika',
            'prodi_id' => 1,
        ]);
        jurusan::create([
            'nama_jurusan' => 'Pertanian',
            'prodi_id' => 2,
        ]);

        prestasi::create([
            'nama_perlombaan_prestasi' => 'Lomba Memancig Nasional',
            'nama_prestasi' => 'Juara 2 International',
            'tingkatan_id' => 2,

        ]);
        prestasi::create([
            'nama_perlombaan_prestasi' => 'Lomba LKTI',
            'nama_prestasi' => 'Juara 1 National',
            'tingkatan_id' => 2,

        ]);

        // Seeder Prestasi //
        mahasiswa_prestasi::create([
            'nim' => '362258302143',
            'nama_mahasiswa' => 'Rahid Tadeo Anugrahaning Gusti',
            'prestasi_id' => 1,
            'jurusan_id' => 1,
            'account_admin_id' => 1,
        ]);
        mahasiswa_prestasi::create([
            'nim' => '362258302177',
            'nama_mahasiswa' => 'Rahmah Sary F',
            'prestasi_id' => 2,
            'jurusan_id' => 2,
            'account_admin_id' => 1,
        ]);
    }
}
