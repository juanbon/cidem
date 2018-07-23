<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('areas')->delete();
        
        \DB::table('areas')->insert(array (
            0 => 
            array (
                'id' => 14,
                'name' => 'Administración Pública local',
            ),
            1 => 
            array (
                'id' => 10,
                'name' => 'Administración pública provincial',
            ),
            2 => 
            array (
                'id' => 16,
                'name' => 'Agricultura, ganadería, pesca y silvicultura',
            ),
            3 => 
            array (
                'id' => 15,
                'name' => 'Agua y saneamiento',
            ),
            4 => 
            array (
                'id' => 7,
                'name' => 'Arte y cultura',
            ),
            5 => 
            array (
                'id' => 1,
                'name' => 'Ciencia y tecnología',
            ),
            6 => 
            array (
                'id' => 9,
                'name' => 'Desarrollo social',
            ),
            7 => 
            array (
                'id' => 13,
                'name' => 'Desarrollo urbano',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'Economía social',
            ),
            9 => 
            array (
                'id' => 6,
                'name' => 'Educación',
            ),
            10 => 
            array (
                'id' => 2,
                'name' => 'Energía',
            ),
            11 => 
            array (
                'id' => 5,
                'name' => 'Industria, comercio y servicios',
            ),
            12 => 
            array (
                'id' => 11,
                'name' => 'Infraestructura, Vivienda y Edificaciones',
            ),
            13 => 
            array (
                'id' => 3,
                'name' => 'Medio Ambiente',
            ),
            14 => 
            array (
                'id' => 8,
                'name' => 'Salud',
            ),
            15 => 
            array (
                'id' => 4,
                'name' => 'Tecnologías de la información y la comunicación',
            ),
        ));
        
        
    }
}