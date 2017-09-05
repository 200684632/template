<?php

use Illuminate\Database\Seeder;
use App\User;

class InitUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();


        $user = User::create([
            'name' => 'cj',
            'email' => 'cj@xianlixiang.com',
            'password' =>  \Hash::make('111111')
        ]);

        $user->syncRoles(['admin']);

        $user->givePermissionTo('test');
    }
}
