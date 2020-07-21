<?php

use App\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::create([
            'name' => 'Funza Technologies',
            'email' => 'admin@funza.com',
            'password' => bcrypt('secret')
        ]);
    }
}
