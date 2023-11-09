<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $data = [
            [
                'name' => "Crealive",
                'surname' => "Admin",
                'email' => "admin@gmail.com",
                "password" => Hash::make("admin123"),
                "status" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];
        foreach($data as $item){
            DB::table('users')->insert($item);
        }
    }
}
