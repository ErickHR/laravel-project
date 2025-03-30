<?php

namespace App\Feature\Login\Domain\UseCase;

interface LoginUseCase {
  public function execute($email, $password);
}