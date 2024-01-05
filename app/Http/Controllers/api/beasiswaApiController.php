<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\beasiswa;
use App\Http\Resources\beasiswaResources;

class beasiswaApiController extends Controller
{
    public function getAllDataBeasiswa()
    {
        $dataBeasiswaAll = beasiswa::all();
        $errorMessage = [
            'statusCode' => '404',
            'message' => 'Not Found Data'
        ];
        if (!empty($dataBeasiswaAll)) {
            return beasiswaResources::collection($dataBeasiswaAll);
        } else {
            return $errorMessage;
        }
    }
    public function getDataBeasiswaByid($id)
    {
        $dataBeasiswaById = beasiswa::where('id', $id)->get();
        $errorMessage = [
            'statusCode' => '404',
            'message' => 'Not Found Data'
        ];
        if (!empty($dataBeasiswaById)) {
            return beasiswaResources::collection($dataBeasiswaById);
        } else {
            return $errorMessage;
        }
    }
    public function getSearchBeasiswaByNama($namaBeasiswa)
    {
        $dataSearchBeasiswaByNama = beasiswa::where('nama_beasiswa', 'like', '%'. $namaBeasiswa . '%')->get();
        $errorMessage = [
            'statusCode' => '404',
            'message' => 'Not Found Data'
        ];
        if (!empty($dataSearchBeasiswaByNama)) {
            return beasiswaResources::collection($dataSearchBeasiswaByNama);
        } else {
            return $errorMessage;
        }
    }
}
