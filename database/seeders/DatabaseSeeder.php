<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $checkuser = User::where('email', 'user@gmail.com')->first();
        if (is_null($checkuser)) {
            $user = new User();
            $user->name = 'User';
            $user->email = 'user@gmail.com';
            $user->password = Hash::make('password');
            $user->save();
        }
    }
}
