<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Contest\Contest;
use App\User\User;

use Faker\Factory as Faker;
use App\Code;

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
            [
                'name' => 'Contest 1',
                'description' => 'This is contest one',
                'start_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 11, 4, 2017)),
                'end_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 11, 5, 2017)),
                'active' => true
            ],
            [
                'name' => 'Contest 2',
                'description' => 'This is contest two',
                'start_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 11, 5, 2017)),
                'end_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 11, 6, 2017)),
                'active' => false
            ],
            [
                'name' => 'Contest 3',
                'description' => 'This is contest three',
                'start_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 11, 6, 2017)),
                'end_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 11, 7, 2017)),
                'active' => false
            ],
            [
                'name' => 'Contest 4',
                'description' => 'This is contest four',
                'start_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 11, 7, 2017)),
                'end_date' => date('Y-m-d G:i:s', mktime(0, 0, 0, 11, 8, 2017)),
                'active' => false
            ]
        ]);

        $faker = Faker::create();


        DB::table('users')->insert([
            'firstName' => 'Piotr',
            'lastName' => 'Mazurek',
            'ipaddress' => $faker->ipv4,
            'role' => 'admin',
            'email' => 'pioma93@hotmail.com',
            'password' => bcrypt('webdev')
        ]);

        foreach (range(2,50) as $index) {
            DB::table('users')->insert([
                'id' => $index,
                'firstName' => $faker->name,
                'lastName' => $faker->name,
                'ipaddress' => $faker->ipv4,
                'role' => 'user',
                'email' => 'pioma93@hotmail.com',
                'password' => bcrypt('secret')
            ]);
        }



        foreach (range(1,100) as $index) {
            DB::table('codes')->insert([
                'code' => $faker->ean13,
                'contest_id' => 1,
                'used_by' => $faker->randomElement(User::all()->pluck('id')->toArray())
            ]);
        }

        foreach (range(1,100) as $index) {
            DB::table('codes')->insert([
                'code' => $faker->ean13,
                'contest_id' => 1,
                'used_by' => null
            ]);
        }

        foreach (range(1,20) as $index) {
            DB::table('contest_user')->insert([
                'user_id' => $faker->randomElement(User::all()->pluck('id')->toArray()),
                'contest_id' => $faker->randomElement(Contest::all()->pluck('id')->toArray()),
                'code_id' => $faker->randomElement(Code::all()->pluck('id')->toArray()),
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today()
            ]);
        }

    }
}
