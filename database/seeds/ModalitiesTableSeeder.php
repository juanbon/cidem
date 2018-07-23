<?php

use Illuminate\Database\Seeder;

class ModalitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('modalities')->delete();
        
        \DB::table('modalities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Convocatoria',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Ventanilla Permanente',
            ),
        ));
        
        
    }
}