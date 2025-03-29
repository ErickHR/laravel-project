<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('uris')->insert([
            [
              'name' => 'api/v1/task',
            ],
            [
              'name' => 'api/v1/task/{task}',
            ],
        ]);
    }
}
