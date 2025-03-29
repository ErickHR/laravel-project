<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// $roles = [
//   'admin' => [
//     [
//       'title' => 'Tarea',
//       'route' => 'perfil',
//       'enabled' => true,
//       'options' => [
//         "read" => [
//           'enable' => true,
//         ],
//         "create" => [
//           'enable' => false,
//         ]
//       ]
//     ]
//   ],
//   'student' => [
//     [
//       'title' => 'Tarea',
//       'route' => 'perfil',
//       'enabled' => true,
//       'options' => [
//         "read" => [
//           'enable' => true,
//         ],
//         "create" => [
//           'enable' => false,
//         ]
//       ]
//     ]
//   ]
// ];



class CheckPermission
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {

    $role = $request->query('role');

    $method = $request->method();
    $uri = $request->route()->uri;

    $roles = Role::with(['permissions', 'permissions.uri','permissions.method'])
      ->where('name', $role)->first();

    if( is_null($roles) || !isset($roles) ) {
      return response()->json([
        'message' => 'You are not authorized to access this route.'
      ], 403);
    }

    $roles = $roles->permissions->toArray();

    foreach($roles as $permission) {
      if( $permission['method']['name'] == $method && $permission['uri']['name'] == $uri ) {
        return $next($request);
      }
    }

    return response()->json([
      'message' => 'You are not authorized to access this route.'
    ], 403);
  }
}
