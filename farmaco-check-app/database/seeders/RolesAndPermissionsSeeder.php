<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * RolesAndPermissionsSeeder seeds roles and permissions into the database.
 *
 * Responsibilities:
 * - Define permissions for managing medicines, interactions, and users.
 * - Create roles (doctor, admin, superadmin) and assign appropriate permissions.
 * - Ensure permissions are cached properly after updates.
 */
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method creates permissions and roles, then assigns the appropriate permissions
     * to each role based on their responsibilities:
     * 
     * - **Permissions**:
     *   - Medicines: view, create, edit, delete
     *   - Interactions: view, create, edit, delete
     *   - Users: view, manage
     * - **Roles**:
     *   - Doctor: Can view medicines and interactions.
     *   - Admin: Can perform CRUD operations on medicines and interactions, and view users.
     *   - SuperAdmin: Has all permissions, including user management.
     */
    public function run(): void
    {
        // Clear cached permissions to ensure a clean state.
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for medicines
        Permission::create(['name' => 'view medicines']);       // Permission to view medicines
        Permission::create(['name' => 'create medicines']);     // Permission to create medicines
        Permission::create(['name' => 'edit medicines']);       // Permission to edit medicines
        Permission::create(['name' => 'delete medicines']);     // Permission to delete medicines

        // Create permissions for medicines
        Permission::create(['name' => 'view interactions']);    // Permission to view interactions
        Permission::create(['name' => 'create interactions']);  // Permission to create interactions
        Permission::create(['name' => 'edit interactions']);    // Permission to edit interactions
        Permission::create(['name' => 'delete interactions']);  // Permission to delete interactions

         // Create permissions for user management
        Permission::create(['name' => 'manage users']); // Permission to manage users (SuperAdmin)
        Permission::create(['name' => 'view users']);   // Permission to view users

        // Refresh cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define roles and assign permissions

        // Doctor: Limited to viewing medicines and interactions
        $roleMedic = Role::create(['name' => 'doctor']);
        $roleMedic->givePermissionTo([
            'view medicines',
            'view interactions',
        ]);

        // Admin: CRUD permissions for medicines and interactions, plus viewing users
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo([
            'view medicines',
            'view interactions',
            'create medicines',
            'create interactions',
            'edit medicines',
            'edit interactions',
            'delete medicines',
            'delete interactions',
            'view users',
        ]);

        // SuperAdmin: Full access, including user management
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleSuperAdmin->givePermissionTo(Permission::all());
    }
}
