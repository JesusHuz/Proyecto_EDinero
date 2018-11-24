<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {//de forma normal pero con factori tambien se puedeen factoris
        $user = new \App\User();
        $user->name = 'Jesus Huz';
        $user->email = 'jesushuz.v@gmail.com';
        $user->password = bcrypt('secret');
        $user->save();


        for ($i=0; $i < 50; $i++) { 
            $user->movimientos()->save(factory(App\Movimiento::class)->make()); //usando la fabrica para hacerle 50 movimientos aeatorios a la base de datos
        }


        factory(App\User::class, 10)->create()->each(function ($u) {
            for ($i=0; $i < 100; $i++) { 
                $u->movimientos()->save(factory(App\Movimiento::class)->make()); //usando la fabrica para hacerle 50 movimientos aeatorios a la base de datos
            }
        }); //se creara 10 usuarios mas con 100 movimientos
    }

    
}
