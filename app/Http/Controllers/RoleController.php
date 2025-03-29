<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Method;
use App\Models\Permission;
use App\Models\Uri;
use App\Models\UriActive;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Role::with(['permissions', 'permissions.uri','permissions.method'])->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {

        $role = Role::create(['name' => $request->name,]);

        if(  $request->permissions == 'full' ) {

            $url_actives = UriActive::where('status', 1)->get();

            foreach ($url_actives as $url_active) {
                Permission::create([
                    'role_id' => $role->id,
                    'uri_id' => $url_active->uri_id,
                    'method_id' => $url_active->method_id
                ]);
            }

         } else if( is_array($request->permissions) ) {
            foreach ($request->permissions as $permission) {
              Permission::create([
                  'role_id' => $role->id,
                  'uri_id' => $permission['uri_id'],
                  'method_id' => $permission['method_id']
              ]);
            }
         }

        return [
            'id' => $role->id,
            'name' => $role->name
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return Role::with(['permissions', 'permissions.uri','permissions.method'])->find($role->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {

        if( isset($request->name) && $request->name != $role->name) {
          $role->name = $request->name;
        }

        if( isset($request->permissions) ) {
          if( $request->permissions == 'full' ) {
            Permission::where('role_id', $role->id)->delete();
            $url_actives = UriActive::where('status', 1)->get();
            foreach ($url_actives as $url_active) {
                Permission::create([
                    'role_id' => $role->id,
                    'uri_id' => $url_active->uri_id,
                    'method_id' => $url_active->method_id
                ]);
            }
          } else if( is_array($request->permissions) ) {
            Permission::where('role_id', $role->id)->delete();
            foreach ($request->permissions as $permission) {
              Permission::create([
                  'role_id' => $role->id,
                  'uri_id' => $permission['uri_id'],
                  'method_id' => $permission['method_id']
              ]);
            }
          }
        }

        $role->save();

        return ['editado'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->status = 0;
        $role->save();
        return 'success';
    }
}
