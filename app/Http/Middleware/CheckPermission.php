<?php

namespace App\Http\Middleware;

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

    $role_id = $request->user()->role_id;
    
    $role = Role::where('id', $role_id)->where('status', true)->first();

    $method = $request->method();
    $uri = $request->route()->uri;

    if (is_null($role) || !isset($role)) {
      return response()->json([
        'message' => 'You are not authorized to access this route.'
      ], 403);
    }

    $roles = Role::with(['permissions', 'permissions.uri', 'permissions.method'])
      ->where('id', $role_id)->first();

    if (is_null($roles) || !isset($roles)) {
      return response()->json([
        'message' => 'You are not authorized to access this route.'
      ], 403);
    }

    $roles = $roles->permissions->toArray();

    foreach ($roles as $permission) {
      if ($permission['method']['name'] == $method && $permission['uri']['name'] == $uri) {
        return $next($request);
      }
    }

    return response()->json([
      'message' => 'You are not authorized to access this route.'
    ], 403);
  }
}
