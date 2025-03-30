<?php

namespace App\Feature\Login\Presentation;

use Illuminate\Support\Facades\Hash;

use App\Core\Constans\Word;
use App\Core\Error\AppError;
use App\Feature\Login\Domain\Repository\UserRepository;
use App\Feature\Login\Domain\UseCase\LoginUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginUseCaseImpl implements LoginUseCase {

  public function __construct(
    private UserRepository $userRepository,
  ){
  }

  public function execute($email, $password) {
    

    $user = $this->userRepository->findByEmail($email);

    if( 
      is_null($user) || 
      !isset($user) ||
      !(
        $user->status  &&
        Hash::check($password, $user->password)
      )
    ) {
      throw AppError::notAuthorized('Invalid credentials', );
    }

    if( !Auth::attempt(['email' => $email, 'password' => $password]) ) {
      throw AppError::notAuthorized('Invalid credentials', );
    }

    Request::session()->regenerate();
    $token = $user->createToken(
      config('app.api_token'),
      ['*'],
      now()->addMinutes(Word::CINCO)
    )->plainTextToken;

    return [
      'token' => $token,
    ];

  }
}
