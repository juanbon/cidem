<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ModalitiesTableSeeder::class);
        $this->call(FinancingTypesTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(LinesTableSeeder::class);
        $this->call(RecipientsTableSeeder::class);
        $this->call(AreaLineTableSeeder::class);
        $this->call(AreaUserTableSeeder::class);
        $this->call(LineRecipientTableSeeder::class);
        $this->call(UsersTableSeeder::class);

    }
}
