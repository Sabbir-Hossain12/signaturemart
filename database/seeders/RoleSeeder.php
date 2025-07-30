<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=['admin','user','vendor'];
        foreach($roles as $role){
            Role::firstOrCreate([
                'name'=>$role,
                'guard_name'=>'web'
            ]);
        }

        $admin= User::find(1);
        $admin->assignRole('admin');

        $teacher= User::find(2);
        $teacher->assignRole('user');

        $student= User::find(3);
        $student->assignRole('vendor');
    }
}
