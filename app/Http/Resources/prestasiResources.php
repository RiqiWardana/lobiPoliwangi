<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class prestasiResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nama_perlombaan_prestasi' => $this->nama_perlombaan_prestasi,
            'nama_prestasi' => $this->nama_prestasi,
            'tingkatan' => new tingkatanResources($this->tingkatan),
        ];
    }
}
