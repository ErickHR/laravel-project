<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      DB::table('permissions')->insert([
          [
            'role_id' => 1,
            'uri_id' => 1,
            'method_id' => 1,
          ],
          [
            'role_id' => 1,
            'uri_id' => 2,
            'method_id' => 1,
          ],
          [
            'role_id' => 1,
            'uri_id' => 1,
            'method_id' => 2,
          ],
          [
            'role_id' => 1,
            'uri_id' => 2,
            'method_id' => 3,
          ],
          
          [
            'role_id' => 1,
            'uri_id' => 2,
            'method_id' => 4,
          ],

          [
            'role_id' => 2,
            'uri_id' => 1,
            'method_id' => 1,
          ],
          [
            'role_id' => 2,
            'uri_id' => 2,
            'method_id' => 1,
          ],
      ]);
    }
}
