<?php

namespace App\Http\Controllers;

use App\Core\Error\AppError;

abstract class Controller
{

    public function sendSuccess($data, $message = null,  $statucCode = 200) {

      $response = [];

      if( $message ) {
        $response['message'] = $message;
      }

      if( $data ) {
        $response['data'] = $data;
      }

      return response()->json($response, $statucCode);
    }

    public function sendError( $th ) {
      if( $th instanceof AppError ) {

        $error = [
          'name' => $th->getNameError(),
          'message' => $th->getMessageError(),
        ];

        if( $th->getValidateErrors() ) {
          $error['errors'] = $th->getValidateErrors();
        }

        return response()->json($error, $th->getCodeStatus());
      }
      return response()->json([
        'name' => 'ERROR',
        'message' => $th->getMessage(),
        'trace' => $th->getTrace(),
      ], 500);
    }
}
