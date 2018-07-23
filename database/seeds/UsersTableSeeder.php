<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 19,
                'name' => 'webmaster',
                'surname' => 'untref',
                'email' => 'webmaster@untref.edu.ar',
                'ocupation' => 'webmaster',
                'password' => '$2y$10$00DBeyTIvfrIhzHjSsXTeuqmUj4lBt0GrTvASQz5ZRnxdPfibe..W',
                'remember_token' => 'qgcxU2cx2zgOe4gT6GB0irsQlgu45WKHBe80yvhjMHcFtzQh1ghgwg60J88b',
                'created_at' => '2018-06-18 22:41:32',
                'updated_at' => '2018-06-18 22:41:32',
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 20,
                'name' => 'roman',
                'surname' => 'litvin',
                'email' => 'rglitvin@gmail.com',
                'ocupation' => 'dev',
                'password' => '$2y$10$nDJzrhIVza0o4Sp6TDCm5uk3SuPzILpGV.d9KLWV0puFkLmCqWRCq',
                'remember_token' => '7JcP7TSDJl5DbTZ5DR8CQ6hKkmASKaZFfSNNpFs9w3LtefcDPgh4jRf4TT2m',
                'created_at' => '2018-06-18 22:47:38',
                'updated_at' => '2018-06-18 22:47:38',
                'status' => 1,
            ),
        ));
        
        
    }
}