<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
                'name' => 'first client',
                'phone' => '0123456789',
                'address' => 'Cairo, Egypt'
        ]);

        Client::create([
            'name' => 'second client',
            'phone' => '0123456789',
            'address' => 'Cairo, Egypt'
        ]);
    }
}
