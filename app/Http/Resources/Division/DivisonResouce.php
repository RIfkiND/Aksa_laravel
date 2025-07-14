<?php

namespace App\Http\Resources\Division;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisonResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'message' => 'Berhasil mengambil data divisi',
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
