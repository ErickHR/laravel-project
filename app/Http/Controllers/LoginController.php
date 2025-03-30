<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Core\Constans\Message;
use App\Core\Error\AppError;
use App\Feature\Login\Domain\UseCase\LoginUseCase;

class LoginController extends Controller
{

    public function __construct( private LoginUseCase $loginUseCase ) {}


    public function authenticate(Request $request) {

      try {

        $validator = Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required',
        ]);

        if($validator->fails()){
          throw AppError::validation(Message::VALIDATION_ERROR, $validator->errors());
        }

        $response = $this->loginUseCase->execute($request->email, $request->password);

        return $this->sendSuccess([
          'token' => $response['token'],
        ]);
        
      } catch (\Throwable $th) {
        return $this->sendError($th);
      }

    }

    public function logout(Request $request) {

      try {

        $request->user()->currentAccessToken()->delete();
        return $this->sendSuccess([], Message::LOGOUT_SUCCESS);

      } catch (\Throwable $th) {
        return $this->sendError($th);
      }
    }

    public function fallbackRoute() {

      try {
        throw AppError::notAuthorized(Message::NOT_AUTHORIZED);
      } catch (\Throwable $th) {
        return $this->sendError($th);
      }
    }
  
}
