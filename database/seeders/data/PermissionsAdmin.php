<?php

namespace Database\Seeders\Data;

use Database\Seeders\Data\Routes\RoutesAuth;
use Database\Seeders\Data\Routes\RoutesTask;
use Database\Seeders\Data\Routes\RoutesRole;
use Database\Seeders\Data\Routes\RoutesProfile;

class PermissionsAdmin
{

  public static function PERMISSIONS()
  {
    return [
      [
        'role_id' => 1,
        ...RoutesTask::GET,
      ],
      [
        'role_id' => 1,
        ...RoutesTask::GET_ONE,
      ],
      [
        'role_id' => 1,
        ...RoutesTask::POST,
      ],
      [
        'role_id' => 1,
        ...RoutesTask::PUT,
      ],
      [
        'role_id' => 1,
        ...RoutesTask::DELETE,
      ],
      [
        'role_id' => 1,
        ...RoutesProfile::GET,
      ],
      [
        'role_id' => 1,
        ...RoutesRole::GET,
      ],
      [
        'role_id' => 1,
        ...RoutesRole::GET_ONE,
      ],
      [
        'role_id' => 1,
        ...RoutesRole::CREATE,
      ],
      [
        'role_id' => 1,
        ...RoutesRole::UPDATE,
      ],
      [
        'role_id' => 1,
        ...RoutesRole::DESTROY,
      ],
      [
        'role_id' => 1,
        ...RoutesAuth::LOGOUT
      ]
    ];
  }
}
