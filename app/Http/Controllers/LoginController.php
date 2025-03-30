<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Core\Constans\Message;
use App\Core\Error\AppError;
use App\Feature\Login\Domain\UseCase\LoginUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
          'token' => explode('|', $response['token'])[1]
        ]);
        
      } catch (\Throwable $th) {
        return $this->sendError($th);
      }

    }

    public function logout(Request $request) {

      try {

        // $request->user()->currentAccessToken()->delete();
        $cookie = Cookie::forget('laravel_session');
        Auth::guard('web')->logout();
        $request->user()->tokens()->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->sendSuccess(null, Message::LOGOUT_SUCCESS)->withCookie($cookie);

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
