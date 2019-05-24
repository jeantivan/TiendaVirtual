<?php

use Illuminate\Database\Seeder;
use App\User;

class ExampleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Admin',
        	'last_name' => 'TiendaVirtual',
        	'email' => 'admin@tiendavirtual.com',
        	'phone_number' => '+584261879921',
        	'email_verified_at' => now(),
        	'password' => Hash::make('admintiendavirtual'), // password
        	'isAdmin' => 1,
        	'remember_token' => Str::random(10),
        ]);

        User::create([
        	'name' => 'Juan',
        	'last_name' => 'Perez',
        	'email' => 'example@gmail.com',
        	'phone_number' => '+580000000',
        	'email_verified_at' => now(),
        	'password' => Hash::make('password'), // password
        	'remember_token' => Str::random(10),
        ]);
    }
}
