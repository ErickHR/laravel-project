<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Method;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Method::create(['name' => 'GET',]);
        Method::create(['name' => 'POST',]);
        Method::create(['name' => 'PUT',]);
        Method::create(['name' => 'DELETE',]);
    }
}
