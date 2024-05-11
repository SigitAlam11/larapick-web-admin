<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Guardian;
use App\Models\PickupLog;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory(10)->create();
        Grade::factory(2)->create();
        Student::factory(10)->create();
        Guardian::factory(15)->create();
        PickupLog::factory(50)->create();
    }
}
