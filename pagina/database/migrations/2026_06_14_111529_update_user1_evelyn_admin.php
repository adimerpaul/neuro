<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use App\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        // Garantiza que el rol admin existe
        Role::firstOrCreate(['name' => 'admin',        'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'participante', 'guard_name' => 'web']);

        $user = User::find(1);
        if (!$user) return;

        // Actualiza nombre y correo
        $user->update([
            'name'  => 'Evelyn Giovanna Ramirez Cube',
            'email' => 'evelyn@neurooruro.bo',
        ]);

        // Asigna rol admin (reemplaza cualquier rol previo)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $user->syncRoles(['admin']);
    }

    public function down(): void
    {
        $user = User::find(1);
        if (!$user) return;

        $user->update([
            'name'  => 'Administrador',
            'email' => 'admin@neurooruro.bo',
        ]);
    }
};
