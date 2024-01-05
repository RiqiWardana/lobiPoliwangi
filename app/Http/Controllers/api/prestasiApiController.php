<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\mahasiswaPrestasiResources;
use App\Models\mahasiswa_prestasi;

class prestasiApiController extends Controller
{
    public function getAllDataPrestasi()
    {
        $dataPrestasiAll = mahasiswa_prestasi::all();
        $errorMessage = [
            'statusCode' => '404',
            'message' => 'Not Found Data'
        ];
        if (!empty($dataPrestasiAll)) {
            return mahasiswaPrestasiResources::collection($dataPrestasiAll);
        } else {
            return $errorMessage;
        }
    }
    public function getDataPrestasiByid($id)
    {
        $dataPrestasiById = mahasiswa_prestasi::where('id', $id)->get();
        $errorMessage = [
            'statusCode' => '404',
            'message' => 'Not Found Data'
        ];
        if (!empty($dataPrestasiById)) {
            return mahasiswaPrestasiResources::collection($dataPrestasiById);
        } else {
            return $errorMessage;
        }
    }
    public function getSearchPrestasiByNama($namaPrestasi)
    {
        $dataSearchPrestasiByNama = mahasiswa_prestasi::where('nama_lomba', 'like', '%'. $namaPrestasi . '%')->get();
        $errorMessage = [
            'statusCode' => '404',
            'message' => 'Not Found Data'
        ];
        if (!empty($dataSearchPrestasiByNama)) {
            return mahasiswaPrestasiResources::collection($dataSearchPrestasiByNama);
        } else {
            return $errorMessage;
        }
    }
}
