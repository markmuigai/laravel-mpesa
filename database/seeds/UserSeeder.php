<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mark Muigai',
            'email' => 'mark@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret')
        ]);
    }
}
