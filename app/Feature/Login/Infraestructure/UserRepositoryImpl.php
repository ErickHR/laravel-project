<?php

namespace App\Feature\Login\Infraestructure;

use App\Feature\Login\Domain\Repository\UserRepository;
use App\Models\User;

class UserRepositoryImpl implements UserRepository {

  public function findByEmail($email) {
    return User::where('email', $email)->first();
  }
}
