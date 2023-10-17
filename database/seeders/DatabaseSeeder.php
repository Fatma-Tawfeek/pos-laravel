<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Role::create([
            'name' => 'Super-Admin'
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('Super-Admin');


        $this->call([
            PermissionSeeder::class,
            CategorySeeder::class,
            WarehouseSeeder::class,
            ProductSeeder::class,
            ClientSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
