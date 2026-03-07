<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario = new User();
        $usuario->name = "admin";
        $usuario->email = "admin@mail.com";
        $usuario->password = bcrypt("admin54321");
        $usuario->save();
    }
}
