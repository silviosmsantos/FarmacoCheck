<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Medicamentos
        Permission::create(['name' => 'view medicines']);       // Visualizar medicamentos
        Permission::create(['name' => 'create medicines']);     // Criar medicamentos
        Permission::create(['name' => 'edit medicines']);       // Editar medicamentos
        Permission::create(['name' => 'delete medicines']);     // Deletar medicamentos

        // Interações
        Permission::create(['name' => 'view interactions']);    // Visualizar interações
        Permission::create(['name' => 'create interactions']);  // Criar interações
        Permission::create(['name' => 'edit interactions']);    // Editar interações
        Permission::create(['name' => 'delete interactions']);  // Deletar interações

        // Usuários
        Permission::create(['name' => 'manage users']); // Gerenciar usuários (SuperAdmin)
        Permission::create(['name' => 'view users']);

        // Atualizar o cache para as permissões recém-criadas
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar roles e atribuir permissões

        // Médicos (apenas visualização)
        $roleMedic = Role::create(['name' => 'doctor']);
        $roleMedic->givePermissionTo([
            'view medicines',
            'view interactions',
        ]);

        // Admins (CRUD de medicamentos e interações)
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

        // SuperAdmins (todas as permissões + gerenciar usuários)
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleSuperAdmin->givePermissionTo(Permission::all());
    }
}
