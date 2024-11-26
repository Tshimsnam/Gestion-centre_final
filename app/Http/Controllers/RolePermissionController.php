<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get(); // Load roles with their associated permissions
        $permissions = Permission::all();

        // Create an array mapping role IDs to their associated permission IDs
        $rolePermissions = [];
        foreach ($roles as $role) {
            $rolePermissions[$role->id] = $role->permissions->pluck('id')->toArray();
        }

        return response()->json([
            'roles' => $roles,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions, // Send the role-permission relationships
        ]);
    }

    public function getUsersRoles()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();

        $userRoles = [];
        foreach ($users as $user) {
            $userRoles[$user->id] = $user->roles->pluck('id')->toArray();
        }

        return response()->json([
            'users' => $users,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    public function updateUserRole(Request $request)
    {
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');
        $assign = $request->input('assign');
        $user = User::find($userId);

        if ($assign === "true") {
            $user->roles()->attach($roleId);
        } else {
            $user->roles()->detach($roleId);
        }

        return response()->json(['message' => 'Rôle de l\'utilisateur mis à jour avec succès']);
    }

    public function removeUserRole(Request $request)
    {
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');

        $user = User::find($userId);
        $user->roles()->detach($roleId);

        return response()->json(['message' => 'Rôle retiré à l\'utilisateur avec succès']);
    }

    public function createPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->name]);

        return response()->json(['message' => 'Permission created successfully!']);
    }

    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->name]);

        return response()->json(['message' => 'Role created successfully!']);
    }

    public function updateRolePermissions(Request $request)
    {
        $role = Role::find($request->role_id);
        $permission = Permission::find($request->permission_id);

        if (!$role || !$permission) {
            return response()->json(['message' => 'Role or Permission not found'], 404);
        }

        $isManageAll = ($permission->name === 'gérer tout');
        $assign = filter_var($request->assign, FILTER_VALIDATE_BOOLEAN);

        if ($assign) {
            if ($isManageAll) {
                $allPermissions = Permission::all();
                $role->syncPermissions($allPermissions);
            } else {
                if (!$role->hasPermissionTo($permission)) {
                    $role->givePermissionTo($permission);
                }
            }
        } else {
            if ($isManageAll) {
                $role->syncPermissions([]); // Clears all permissions
            } else {
                if ($role->hasPermissionTo($permission)) {
                    $role->revokePermissionTo($permission);
                }
            }
        }

        Artisan::call('permission:cache-reset');

        return response()->json(['message' => 'Permission updated successfully']);
    }

    public function updatePermission(Request $request, Permission $permission)
    {
        try {
            $permission->name = $request->input('name');
            $permission->save();
            return response()->json(['message' => 'Permission updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating permission: ' . $e->getMessage()], 500);
        }
    }

    public function destroyPermission(Request $request, Permission $permission)
    {
        try {
            $permission->delete();
            return response()->json(['message' => 'Permission deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting permission: ' . $e->getMessage()], 500);
        }
    }

    public function updateRole(Request $request, Role $role)
    {
        try {
            $role->name = $request->input('name');
            $role->save();
            return response()->json(['message' => 'Role updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating role: ' . $e->getMessage()], 500);
        }
    }

    public function destroyRole(Request $request, Role $role)
    {
        try {
            $role->delete();
            return response()->json(['message' => 'Role deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting role: ' . $e->getMessage()], 500);
        }
    }
}