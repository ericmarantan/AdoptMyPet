<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make("12345678");
        $adminRecords = [
            ['id' => 2, 
            'name' => 'Admin', 
            'type' => 'admin',
            'mobile' => 6042884125,
            'email' => 'ericm1986@gmail.com',
            'password'=> $password,
            'image' =>'',
            'status'=> 1],

        ];
        Admin::insert($adminRecords);
    }
}
