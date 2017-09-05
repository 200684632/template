<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class InitRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'deliveryman', 'packingman', 'operator'];
        foreach ($roles as $role) {
            Role::create(['name' => $role, 'guard_name' => 'api']);
        }

    }
}
