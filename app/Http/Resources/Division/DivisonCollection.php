<?php

namespace App\Http\Resources\Division;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DivisonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
            'status' => 'success',
            'message' => 'Berhasil mengambil daftar divisi',
            'data' => [
                'divisions' => $this->collection,
            ],
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
                'from' => $this->firstItem(),
                'to' => $this->lastItem(),
            ],
        ];
    }
}
