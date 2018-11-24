<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);//cuales se ejecutara por defecto en que orden se crearan
         $this->call(CategoriasTableSeeder::class);
         $this->call(UsersTableSeeder::class);
    }
}
