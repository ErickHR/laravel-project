<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Database\Seeders\Data\Routes\RoutesRole;
use Database\Seeders\Data\Routes\RoutesTask;
use Database\Seeders\Data\Routes\RoutesProfile;
use Database\Seeders\Data\Routes\RoutesAuth;

class UriActiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('uri_actives')->insert([
          RoutesTask::GET,
          RoutesTask::GET_ONE,
          RoutesTask::POST,
          RoutesTask::PUT,
          RoutesTask::DELETE,

          RoutesRole::GET,
          RoutesRole::GET_ONE,
          RoutesRole::CREATE,
          RoutesRole::UPDATE,
          RoutesRole::DESTROY,

          RoutesProfile::GET,
          RoutesAuth::LOGOUT
        ]);
    }
}
