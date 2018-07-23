<?php

use Illuminate\Database\Seeder;

class AreaUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('area_user')->delete();
        
        \DB::table('area_user')->insert(array (
            0 => 
            array (
                'area_id' => 14,
                'user_id' => 12,
            ),
            1 => 
            array (
                'area_id' => 15,
                'user_id' => 12,
            ),
            2 => 
            array (
                'area_id' => 7,
                'user_id' => 12,
            ),
            3 => 
            array (
                'area_id' => 9,
                'user_id' => 12,
            ),
            4 => 
            array (
                'area_id' => 14,
                'user_id' => 13,
            ),
            5 => 
            array (
                'area_id' => 6,
                'user_id' => 13,
            ),
            6 => 
            array (
                'area_id' => 13,
                'user_id' => 13,
            ),
            7 => 
            array (
                'area_id' => 2,
                'user_id' => 13,
            ),
            8 => 
            array (
                'area_id' => 10,
                'user_id' => 14,
            ),
            9 => 
            array (
                'area_id' => 6,
                'user_id' => 14,
            ),
            10 => 
            array (
                'area_id' => 1,
                'user_id' => 14,
            ),
            11 => 
            array (
                'area_id' => 13,
                'user_id' => 14,
            ),
            12 => 
            array (
                'area_id' => 14,
                'user_id' => 20,
            ),
            13 => 
            array (
                'area_id' => 13,
                'user_id' => 20,
            ),
            14 => 
            array (
                'area_id' => 8,
                'user_id' => 20,
            ),
        ));
        
        
    }
}