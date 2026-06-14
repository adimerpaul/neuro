<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Usuarios
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            // Cronograma
            'ver-cronograma',
            'gestionar-cronograma',
            // Cursos
            'ver-cursos',
            'crear-cursos',
            'editar-cursos',
            'eliminar-cursos',
            // Contenido del curso
            'ver-contenido',
            'crear-contenido',
            'editar-contenido',
            'eliminar-contenido',
            // Inscripciones
            'ver-inscripciones',
            'confirmar-inscripciones',
            'eliminar-inscripciones',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions($permissions);

        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions([
            'ver-cronograma', 'gestionar-cronograma',
            'ver-cursos', 'crear-cursos', 'editar-cursos',
            'ver-contenido', 'crear-contenido', 'editar-contenido',
            'ver-inscripciones',
        ]);

        $usuario = Role::firstOrCreate(['name' => 'usuario']);
        $usuario->syncPermissions([
            'ver-cronograma',
            'ver-cursos',
            'ver-contenido',
        ]);
    }
}
