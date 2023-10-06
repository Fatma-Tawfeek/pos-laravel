<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  DB::table('categories')->insert([
        //     'name' => [
        //         'ar' => 'القسم الاول',
        //         'en' => 'First Category'
        //     ],
        // ]);

        Category::create([
            'name' => [
                'ar' => 'القسم الاول',
                'en' => 'First Category'
            ]
         ]);

         Category::create([
            'name' => [
                'ar' => 'القسم الثاني',
                'en' => 'Second Category'
            ]
         ]);

         Category::create([
            'name' => [
                'ar' => 'القسم الثالث',
                'en' => 'Third Category'
            ]
         ]);
    }
}
