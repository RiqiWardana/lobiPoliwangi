<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class mahasiswaPrestasiResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nim' => $this->nim,
            'nama_mahasiswa' => $this->nama_mahasiswa,
            'prestasi' => new prestasiResources($this->prestasi),
            'jurusan' => new jurusanResources($this->jurusan),
            'account_admin' => new accountAdminResources($this->accountAdmin),
            'created_at' => $this -> created_at,
        ];
    }
}
