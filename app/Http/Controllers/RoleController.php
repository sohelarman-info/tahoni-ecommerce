<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    function RoleManager(){
        // $role = Role::create(['name' => 'Subscriber']);
        // $permission = Permission::create(['name' => 'Restore']);
        return view('backend.role',[
            'roles'         => Role::all(),
            'permissions'   => Permission::all(),
            'users'         => User::all()
        ]);
    }
    //Permission
    function RoleAddToPermission(Request $request){
        $role_name          = $request->role_name;
        $permission_name    = $request->permission_name;
        $role = Role::where('name', $role_name)->first();

        //Multiple Permission
        //$role->givePermissionTo($permission_name);

        //Single Permission
        $role->syncPermissions($permission_name);
        return back();
    }

    //User Permission
    function RoleAddToUser(Request $request){
        // return $request->all();
        $user_id          = $request->user_id;
        $user_role        = $request->user_role;
        $user = User::findOrFail($user_id);

        // Multiple Role
        $user->assignRole($user_role);

        // Single Role
        // $user->syncRoles($user_role);

        return back();
    }
    function PermissionChange($user_id){
         $user =  User::findOrFail($user_id);
        return view('backend.edit-permission',[
            'permissions'   => Permission::all(),
            'user'          => $user,
        ]);
    }
    function PermissionChangeToUser(Request $request){
        $user = User::findOrFail($request->user_id);
        $user->syncPermissions($request->permission);
        return back();
    }
}
