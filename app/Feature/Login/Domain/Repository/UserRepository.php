<?php

namespace App\Feature\Login\Domain\Repository;

interface UserRepository
{
  public function findByEmail($email);
}
