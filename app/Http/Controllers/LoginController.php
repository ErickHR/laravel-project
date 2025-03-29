<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request) {

      $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
      ]);

     

      if($validator->fails()){
        return [
          'success' => false,
          'message' => 'Validation Error.',
          'errors' => $validator->errors()
        ];
      }

      $user = User::where('email', $request->email)->first();

      if( 
        is_null($user) || 
        !isset($user) ||
        !(
          $user->status  &&
          Hash::check($request->password, $user->password)
        )
      ) {
        return [
          'success' => false,
        ];
      }

      // Auth::login($user);

      $token = $user->createToken(
          config('app.api_token'),
          ['*'],
          now()->addMinutes(5)
        )->plainTextToken;

      return [
        'success' => true,
        'token' => $token
      ];

    }

    public function logout(Request $request) {
      $request->user()->currentAccessToken();
      return [
        'success' => true
      ];
    }
}
