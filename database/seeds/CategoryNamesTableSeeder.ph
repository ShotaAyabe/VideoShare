<?php

use Illuminate\Database\Seeder;

class CategoryNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_names')->insert([
            'name' => '撮影方法',
        ]);
    
        DB::table('category_names')->insert([
            'name' => '使用機材',
        ]);
    
        DB::table('category_names')->insert([
            'name' => '都道府県',
        ]);
    }
}
