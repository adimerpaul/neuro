<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
//            VideoSeeder::class,
            // UserSeeder::class,
        ]);
        $inscritos = Excel::toArray(new UsersImport, public_path('Inscripción Neurología & Emergencias Neurológicas. (Respuestas).xlsx'));
        foreach ($inscritos[0] as $inscrito) {
            error_log("inscrito". json_encode($inscrito));
            $user = new User();
            $user->firstName=$inscrito['primer_nombre'];
            $user->secondName=$inscrito['segundo_nombre'];
            $user->lastName=$inscrito['primer_apellido'];
            $user->secondLastName=$inscrito['segundo_apellido'];
            $user->phone=$inscrito['nro_de_celular'];
            $user->profession=$inscrito['profesion'];
            $user->email=$inscrito['correo_electronico'];
            $user->password=bcrypt($inscrito['nro_de_ci']);
            $user->departamento=$inscrito['departamento'];
            $user->provincia=$inscrito['provinciamunicipioregion'];
            $user->direccion=$inscrito['direccion'];
            $user->ci=$inscrito['nro_de_ci'];
            $user->celular=$inscrito['nro_de_celular'];
            $user->correo=$inscrito['direccion_de_correo_electronico'];
            $user->photo=$inscrito['adjuntar_archivo_de_pago'];
            $user->save();
        }
        $sql = storage_path('sql/videos.sql');
        DB::unprepared(file_get_contents($sql));
    }
}
