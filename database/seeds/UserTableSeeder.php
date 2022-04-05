<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'web.team',
                'username' => 'Web Team',
                'email' => 'web.team@eecegypt.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'kareem.saleh',
                'username' => 'Kareem Saleh',
                'email' => 'kareem.saleh@eecegypt.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'paul.youssif',
            'username' => 'Paul Youssif',
            'email' => 'paul85anton@gmail.com',
            'password' => bcrypt('123456'),
            ],
            [
                'name' => 'waleed.seif',
            'username' => 'Waleed Seif',
            'email' => 'waleed.seif@eecegypt.com',
            'password' => bcrypt('123456'),
            ],
            [
                'name' => 'ahmed.adel',
            'username' => 'Ahmed Adel',
            'email' => 'ahmedadel199623@gmail.com',
            'password' => bcrypt('123456'),
            ],
            [
                'name' => 'amira.anwar',
                'username' => 'Amira Anwar',
                'email' => 'amira.anwar@eecegypt.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'dina.nayl',
            'username' => 'Dina Nayl',
            'email' => 'dina.nayl@eecegypt.com',
            'password' => bcrypt('123456'),
            ],
            [
                'name' => 'rasha.samir',
                'username' => 'Rasha Samir',
                'email' => 'rasha.samir@roxegypt.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'nermine.shawky',
                'username' => 'Nermine Shawky',
                'email' => 'nermine.shawky@eecegypt.com',
                'password' => bcrypt('123456'),
            ],
       
        ];


        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],

            ]);
        }


        // $user = User::create([
        //     'name' => 'Super admin',
        //     'email' => 'superadmin@gmail.com',
        //     'password' => bcrypt('123456')
        // ]);
    }
}
