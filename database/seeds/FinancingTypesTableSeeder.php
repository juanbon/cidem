<?php

use Illuminate\Database\Seeder;

class FinancingTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('financing_types')->delete();
        
        \DB::table('financing_types')->insert(array (
            0 => 
            array (
                'id' => 4,
            'name' => 'Aporte no reembolsable (ANR)',
            ),
            1 => 
            array (
                'id' => 5,
                'name' => 'Bienes y/o servicios',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Crédito',
            ),
            3 => 
            array (
                'id' => 1,
                'name' => 'Subsidio',
            ),
            4 => 
            array (
                'id' => 2,
                'name' => 'Subvención',
            ),
        ));
        
        
    }
}