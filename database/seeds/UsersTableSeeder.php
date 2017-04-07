<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(
            [
                'name' => 'Marcus Campos',
                'email' => 'marcus.campos@devyzi.com',
                'password' => bcrypt('987987'),
                'role' => 'admin',
                'remember_token' => str_random(10),
            ]
        );


        factory(User::class, 3)->create();
    }
}
