<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\lombaResources;
use App\Models\lomba;

class lombaApiController extends Controller
{
    public function getAllDataLomba()
    {
        $dataLombaAll = lomba::all();
        $errorMessage = [
            'statusCode' => '404',
            'message' => 'Not Found Data'
        ];
        if (!empty($dataLombaAll)) {
            return lombaResources::collection($dataLombaAll);
        } else {
            return $errorMessage;
        }
    }
    public function getDataLombaByid($id)
    {
        $dataLombaById = lomba::where('id', $id)->get();
        $errorMessage = [
            'statusCode' => '404',
            'message' => 'Not Found Data'
        ];
        if (!empty($dataLombaById)) {
            return lombaResources::collection($dataLombaById);
        } else {
            return $errorMessage;
        }
    }
    public function getSearchLombaByNama($namaLomba)
    {
        $dataSearchLombaByNama = lomba::where('nama_lomba', 'like', '%'. $namaLomba . '%')->get();
        $errorMessage = [
            'statusCode' => '404',
            'message' => 'Not Found Data'
        ];
        if (!empty($dataSearchLombaByNama)) {
            return lombaResources::collection($dataSearchLombaByNama);
        } else {
            return $errorMessage;
        }
    }
}
