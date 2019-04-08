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
        factory(User::class)->create([
            'name' => 'David García',
            'email' => 'ccristhiangarcia@gmail.com',
            'password' => bcrypt('secret')
        ]);

        factory(User::class)->times(10)->create();
    }
}
