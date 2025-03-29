<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Database\Seeders\Data\PermissionsAdmin;
use Database\Seeders\Data\PermissionsStudent;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      DB::table('permissions')->insert([
          ...PermissionsAdmin::PERMISSIONS(),
          ...PermissionsStudent::PERMISSIONS(),
      ]);
    }
}
