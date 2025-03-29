<?php

namespace Database\Seeders\Data;

use Database\Seeders\Data\Routes\RoutesAuth;
use Database\Seeders\Data\Routes\RoutesTask;
use Database\Seeders\Data\Routes\RoutesRole;
use Database\Seeders\Data\Routes\RoutesProfile;

class PermissionsStudent
{

  public static function PERMISSIONS()
  {
    return [
      [
        'role_id' => 2,
        ...RoutesTask::GET,
      ],
      [
        'role_id' => 2,
        ...RoutesTask::GET_ONE,
      ],
      [
        'role_id' => 2,
        ...RoutesProfile::GET,
      ],
      [
        'role_id' => 2,
        ...RoutesRole::GET,
      ],
      [
        'role_id' => 2,
        ...RoutesAuth::LOGOUT
      ],
    ];
  }
}
