<?php

namespace Database\Seeders;

use App\Models\TrainingSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionsSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CoachesSeeder::class);
        $this->call(UsersSeeder::class);

        $this->call(TrainingSessionSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(TrainingSessionUserSeeder::class);
        $this->call(AddNewEmailTOUSer::class);
    }
}
