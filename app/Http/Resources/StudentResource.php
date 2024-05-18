<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'name' => $this->name,
            'place_of_birth' => $this->place_of_birth,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'address' => $this->address,
            'phone' => $this->phone,
            'image' => $this->image_url,
            'class' => GradeResource::make($this->grade),
            'guardians' => $this->users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'id_number' => $user->id_number,
                    'gender' => $user->gender,
                    'relationship' => $user->relationship,
                    'job' => $user->job,
                    'address' => $user->address,
                    'phone' => $user->phone,
                    'image' => $user->image_url,
                ];
            }),
        ];
    }
}
