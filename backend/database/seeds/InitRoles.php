<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InitRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = Role::create(['name' => 'admin', 'guard_name' => 'api']);

        Permission::create([
            'guard_name' => 'api', 'name' => 'test'
        ]);

        $role->givePermissionTo('test');
    }
}
