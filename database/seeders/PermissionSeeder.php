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
            [   'name' => 'settings.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'roles.view',
                'guard_name' => 'web'
            ],
            [
                'name' => 'roles.create',
                'guard_name' => 'web'
            ],
            [   'name' => 'roles.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'roles.delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'users.view',
                'guard_name' => 'web'
            ],
            [
                'name' => 'users.create',
                'guard_name' => 'web'
            ],
            [   'name' => 'users.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'users.delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'warehouses.view',
                'guard_name' => 'web'
            ],
            [
                'name' => 'warehouses.create',
                'guard_name' => 'web'
            ],
            [   'name' => 'warehouses.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'warehouses.delete',
                'guard_name' => 'web'
            ],
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
            ],
            [
                'name' => 'products.view',
                'guard_name' => 'web'
            ],
            [
                'name' => 'products.create',
                'guard_name' => 'web'
            ],
            [   'name' => 'products.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'products.delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'clients.view',
                'guard_name' => 'web'
            ],
            [
                'name' => 'clients.create',
                'guard_name' => 'web'
            ],
            [   'name' => 'clients.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'clients.delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'orders.view',
                'guard_name' => 'web'
            ],
            [
                'name' => 'orders.create',
                'guard_name' => 'web'
            ],
            [   'name' => 'orders.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'orders.delete',
                'guard_name' => 'web'
            ]                           
        ]);
    }
}
