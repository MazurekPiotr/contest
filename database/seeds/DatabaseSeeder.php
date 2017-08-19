<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Contest;
use App\User;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('contests')->insert([
            [   'name' => 'Contest 1',
                'description' => 'This is contest one',
                'start_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 8, 12, 2017)),
                'end_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 8, 20, 2017)),
                'question' => 'What is my favourite color?',
                'answer' => 'test'
            ],
            [   'name' => 'Contest 2',
                'description' => 'This is contest two',
                'start_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 8, 12, 2017)),
                'end_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 8, 20, 2017)),
                'question' => 'What is Sam\'s favourite food?',
                'answer' => 'pizza'
            ],
            [   'name' => 'Contest 3',
                'description' => 'This is contest three',
                'start_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 8, 12, 2017)),
                'end_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 8, 22, 2017)),
                'question' => 'What is the heigth of the Catherdral of Antwerp? (in meters)',
                'answer' => '123'
            ],
            [   'name' => 'Contest 4',
                'description' => 'This is contest four',
                'start_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 8, 12, 2017)),
                'end_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 8, 22, 2017)),
                'question' => 'What colour is the sea?',
                'answer' => 'blue'
            ]
            ]);
        DB::table('users')->insert([
            'firstName' => 'Piotr',
            'lastName' => 'Mazurek',
            'streetName' => 'Vrijgeweide',
            'houseNumber' => '3',
            'city' => 'Borgerhout',
            'country' => 'Belgium',
            'ipaddress' => '127.0.0.1',
            'role' => 'admin',
            'email' => 'pioma93@hotmail.com',
            'password' => bcrypt('webdev')
        ]);

        $faker = Faker::create();
        foreach (range(2,50) as $index) {
            DB::table('users')->insert([
                'id' => $index,
                'firstName' => $faker->name,
                'lastName' => $faker->name,
                'streetName' => $faker->streetName,
                'houseNumber' => $faker->randomNumber,
                'city' => $faker->city,
                'country' => $faker->country,
                'ipaddress' => $faker->ipv4,
                'role' => 'user',
                'email' => 'pioma93@hotmail.com',
                'password' => bcrypt('secret')
            ]);
        }

        foreach (range(1,20) as $index) {
            DB::table('contest_user')->insert([
                'user_id' => $faker->randomElement(User::all()->pluck('id')->toArray()),
                'contest_id' => $faker->randomElement(Contest::all()->pluck('id')->toArray()),
                'answer' => 'test'
            ]);
        }

    }
}
