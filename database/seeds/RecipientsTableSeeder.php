<?php

use Illuminate\Database\Seeder;

class RecipientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('recipients')->delete();
        
        \DB::table('recipients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Comunidad',
            ),
            1 => 
            array (
                'id' => 6,
                'name' => 'Cooperativas',
            ),
            2 => 
            array (
                'id' => 7,
                'name' => 'Emprendedores',
            ),
            3 => 
            array (
                'id' => 2,
                'name' => 'Empresas',
            ),
            4 => 
            array (
                'id' => 3,
                'name' => 'Gobierno Local',
            ),
            5 => 
            array (
                'id' => 8,
                'name' => 'Gobierno Provincial',
            ),
            6 => 
            array (
                'id' => 4,
                'name' => 'MIPyMEs',
            ),
            7 => 
            array (
                'id' => 12,
                'name' => 'Organismo CyT',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Organización de la Sociedad Civil',
            ),
            9 => 
            array (
                'id' => 5,
                'name' => 'Otros',
            ),
            10 => 
            array (
                'id' => 10,
                'name' => 'Productores Familiares',
            ),
            11 => 
            array (
                'id' => 11,
                'name' => 'Universidad',
            ),
        ));
        
        
    }
}