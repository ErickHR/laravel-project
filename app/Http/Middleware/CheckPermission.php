<?php

namespace App\Http\Middleware;

use App\Core\Constans\Message;
use App\Core\Error\AppError;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {

    try {
      $role_id = $request->user()->role_id;

      $role = Role::where('id', $role_id)->where('status', true)->first();

      $method = $request->method();
      $uri = $request->route()->uri;

      if (is_null($role) || !isset($role)) {
        throw AppError::notAuthorized(Message::NOT_AUTHORIZED);
      }

      $roles = Role::with(['permissions', 'permissions.uri', 'permissions.method'])
        ->where('id', $role_id)->first();

      if (is_null($roles) || !isset($roles)) {
        throw AppError::notAuthorized(Message::NOT_AUTHORIZED);
      }

      $roles = $roles->permissions->toArray();

      foreach ($roles as $permission) {
        if ($permission['method']['name'] == $method && $permission['uri']['name'] == $uri) {
          return $next($request);
        }
      }

      throw AppError::notAuthorized(Message::NOT_AUTHORIZED);;

    } catch (\Throwable $th) {
      if ($th instanceof AppError) {
        return response()->json([
          'name' => $th->getNameError(),
          'message' => $th->getMessageError(),
        ], $th->getCodeStatus());
      }
      return response()->json([
        'name' => 'ERROR',
        'message' => $th->getMessage(),
        'trace' => $th->getTrace(),
      ], 500);
    }
  }
}
