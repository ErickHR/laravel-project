<?php

namespace Database\Seeders;

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

        $user_admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $user_student = User::factory()->create([
          'name' => 'Student',
          'email' => 'student@example.com',
        ]);

        $this->call([
          MethodSeeder::class,
          UriSeeder::class,
          RoleSeeder::class,
          PermissionSeeder::class,
          UriActiveSeeder::class,
        ]);

        $user_admin->role_id = 1;
        $user_admin->save();

        $user_student->role_id = 2;
        $user_student->save();
    }
}
