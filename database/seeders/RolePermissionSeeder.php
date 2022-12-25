<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // The four basic roles we need
        $superadmin = Role::create([
            'name' => 'superadmin',
            'description' => 'Can control anything in website and no role can manage him.'
        ]);
        $admin = Role::create([
            'name' => 'admin',
            'description' => 'Can control anything in website depends on permissions and only superadmin can manage him.'
        ]);
        $teacher = Role::create([
            'name' => 'teacher',
            'description' => 'A normal teacher can do what his permissions are set for.'
        ]);
        $student = Role::create([
            'name' => 'student',
            'description' => 'Just an average student user. Less permissions for his little abilities.'
        ]);

        // Basic permissions we need. We gonna keep adding permissions here as we go.
        $list_role = Permission::create(['name' => 'List roles', 'slug' => 'list-role']);
        $create_role = Permission::create(['name' => 'Create role', 'slug' => 'create-role']);
        $read_role   = Permission::create(['name' => 'Read role', 'slug' => 'read-role']);
        $update_role = Permission::create(['name' => 'Update role', 'slug' => 'update-role']);
        $delete_role = Permission::create(['name' => 'Delete role', 'slug' => 'delete-role']);

        $list_user = Permission::create(['name' => 'List users', 'slug' => 'list-user']);
        $create_user = Permission::create(['name' => 'Create user', 'slug' => 'create-user']);
        $read_user   = Permission::create(['name' => 'Read user', 'slug' => 'read-user']);
        $update_user = Permission::create(['name' => 'Update user', 'slug' => 'update-user']);
        $delete_user = Permission::create(['name' => 'Delete user', 'slug' => 'delete-user']);

        // Assign roles and permissions
        $superadmin->permissions()->sync(Permission::pluck('id'));
        $admin->permissions()->sync([$list_user->id, $create_user->id, $read_user->id, $update_user->id, $delete_user->id]);
        $teacher->permissions()->sync([]);
        $student->permissions()->sync([]);
    }
}
