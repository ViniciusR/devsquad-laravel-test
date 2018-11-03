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
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('secret'),
            'city' => 'Guarapuava',
            'state' => 'Paraná',
            'postal_code' => '123456',
            'address' => 'Street any',
            'number' => '4321',
            'district' => 'Darlington County',
            'admin' => true,
        ]);
    }
}
