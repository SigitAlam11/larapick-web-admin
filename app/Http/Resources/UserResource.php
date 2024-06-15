<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $userData = [
            'id' => $this->id,
            'id_number' => $this->id_number,
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->gender,
            'relationship' => $this->relationship,
            'job' => $this->job,
            'address' => $this->address,
            'phone' => $this->phone,
            'qr_code' => $this->qr_code,
            'image' => $this->image_url,
            'is_admin' => $this->is_admin,
        ];

        if ($this->student) {
            $studentData = [
                'id' => $this->student->id,
                'name' => $this->student->name,
                'place_of_birth' => $this->student->place_of_birth,
                'date_of_birth' => $this->student->date_of_birth,
                'gender' => $this->student->gender,
                'address' => $this->student->address,
                'phone' => $this->student->phone,
                'status' => $this->student->status,
                'image' => $this->student->image_url,
                'class' => GradeResource::make($this->student->grade),
            ];
        } else {
            // If student is null, set studentData to null
            $studentData = null;
        }

        $userData['student'] = $studentData;

        return $userData;
    }
}
