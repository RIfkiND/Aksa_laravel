<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //
        return [
            'id' => $this->id,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'name' => $this->name,
            'phone' => $this->phone,
            'division' => $this->whenLoaded(
                'Divisions',
                function () {
                    return [
                        'id' => $this->Divisions->id ?? $this->division,
                        'name' => $this->Divisions->name ?? $this->division,
                    ];
                }
            ),
            'position' => $this->position,
        ];
    }
}
