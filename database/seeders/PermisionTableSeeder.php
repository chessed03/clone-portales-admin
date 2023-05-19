<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'user_id'     => '1',
            'permissions' => '[{"read": [], "write": ["1"], "module_id": "2"}, {"read": [], "write": ["1"], "module_id": "3"}, {"read": [], "write": ["1"], "module_id": "5"}, {"read": [], "write": ["1"], "module_id": "6"}, {"read": [], "write": ["1"], "module_id": "7"}, {"read": [], "write": ["1"], "module_id": "8"}, {"read": [], "write": ["1"], "module_id": "9"}, {"read": [], "write": ["1"], "module_id": "10"}, {"read": [], "write": ["1"], "module_id": "11"}, {"read": [], "write": ["1"], "module_id": "12"}, {"read": [], "write": ["1"], "module_id": "13"}]',
            'created_by'  => '1-Root',
        ]);
    }
}