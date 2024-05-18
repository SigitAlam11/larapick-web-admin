<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupLog extends Model
{
    use HasFactory;

    public function guardian()
    {
        return $this->belongsTo(User::class, 'guardian_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }


    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
