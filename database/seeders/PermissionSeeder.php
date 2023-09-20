<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'name' => 'categories.view',
                'guard_name' => 'web'
            ],
            [
                'name' => 'categories.create',
                'guard_name' => 'web'
            ],
            [   'name' => 'categories.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'categories.delete',
                'guard_name' => 'web'
            ]            
        ]);
    }
}