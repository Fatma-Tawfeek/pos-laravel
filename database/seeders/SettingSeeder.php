<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'app_name', 'value' => 'Smart'],
            ['key' => 'description', 'value' => 'Point of Sale system.'],
            ['key' => 'currency', 'value' => 'EGP'],
            ['key' => 'logo', 'value' => 'logo.png'],
            ['key' => 'default_warehouse', 'value' => 1],
            ['key' => 'favicon', 'value' => 'favicon.png'],
        ];
        Setting::insert($settings);
    }
}
