<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class adminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('012345678'),
        ]);
        $role1= Role::create(['name' => 'admin']);
        $role2= Role::create(['name' => 'customer']);
        $admin -> assignRole([$role1 -> id]);
    }
}
