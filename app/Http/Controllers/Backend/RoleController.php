<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission',compact('permissions'));
    } // end method
    
    public function AddPermission(){
        return view('backend.pages.permission.add_permission');
    } // end method

    public function StorePermission(Request $request){
        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission inserted successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.permission')->with($notification);
    } // end method

    public function EditPermission($id){
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission',compact('permission'));

    } // end method

    public function UpdatePermission(Request $request){
        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.permission')->with($notification);

    } // end method

    public function DeletePermission($id){
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } // end method

    // Roles method
    public function AllRoles(){
        $roles = Role::all();
        return view('backend.pages.roles.all_roles',compact('roles'));
    } // end method

    public function AddRoles(){
        return view('backend.pages.roles.add_roles');
    } // end method

    public function StoreRoles(Request $request){
        $role = Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Roles inserted successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.roles')->with($notification);
    } // end method

    public function EditRoles($id){
        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles',compact('roles'));
    } // end method

    public function UpdateRoles(Request $request){
        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Roles updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.roles')->with($notification);
    } // end method

    public function DeleteRoles($id){
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Roles Deleted successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } // end method
}
