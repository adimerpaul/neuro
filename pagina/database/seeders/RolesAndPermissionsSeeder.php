<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'ver-usuarios', 'crear-usuarios', 'editar-usuarios', 'eliminar-usuarios',
            'ver-cronograma', 'gestionar-cronograma',
            'ver-cursos', 'crear-cursos', 'editar-cursos', 'eliminar-cursos',
            'ver-contenido', 'crear-contenido', 'editar-contenido', 'eliminar-contenido',
            'ver-inscripciones', 'confirmar-inscripciones', 'eliminar-inscripciones',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        Role::firstOrCreate(['name' => 'participante']);

        // Create admin user
        $adminUser = User::updateOrCreate(
            ['nickname' => 'admin'],
            [
                'name'     => 'Administrador',
                'email'    => 'admin@neurooruro.bo',
                'password' => Hash::make('admin1234'),
            ]
        );
        $adminUser->assignRole('admin');
    }
}
