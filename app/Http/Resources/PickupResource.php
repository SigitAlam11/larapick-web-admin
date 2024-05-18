<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PickupResource extends JsonResource
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
            'pickup_time' => $this->pickup_time,
            'student' => [
                'id' => $this->student->id,
                'name' => $this->student->name,
            ],
            'guardian' => [
                'id' => $this->guardian->id,
                'name' => $this->guardian->name,
            ],
            'admin' => [
                'id' => $this->admin->id,
                'name' => $this->admin->name,
            ],
        ];
    }
}
