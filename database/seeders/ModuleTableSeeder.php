<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('modules')->insert([
            'module_id'  => '',
            'position'   => '1',
            'name'       => 'Configuración',
            'route'      => '#',
            'icon'       => 'bx bx-fw bxs-cog',
            'level'      => '0',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '1',
            'position'   => '2',
            'name'       => 'Usuarios',
            'route'      => 'user-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '1',
            'position'   => '3',
            'name'       => 'Universidades',
            'route'      => 'school-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '',
            'position'   => '4',
            'name'       => 'Publicación',
            'route'      => '#',
            'icon'       => 'bx bx-fw bxl-digitalocean',
            'level'      => '0',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '5',
            'name'       => 'Publicaciones',
            'route'      => 'post-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '6',
            'name'       => 'Sitios',
            'route'      => 'site-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '7',
            'name'       => 'Carrusel de imágenes',
            'route'      => 'carousel-image-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '8',
            'name'       => 'Eventos',
            'route'      => 'event-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '9',
            'name'       => 'Cursos',
            'route'      => 'course-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '10',
            'name'       => 'Certificaciones',
            'route'      => 'certification-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '11',
            'name'       => 'Programas',
            'route'      => 'program-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '12',
            'name'       => 'Preguntas',
            'route'      => 'faq-question-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '13',
            'name'       => 'Videos',
            'route'      => 'video-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

    }
}
