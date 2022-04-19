<?php

use Illuminate\Database\Seeder;

class CategoryDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_details')->insert([
            'name' => '徒歩',
            'category_name_id'=>1
        ]);
    
        DB::table('category_details')->insert([
            'name' => '車',
            'category_name_id'=>1
        ]);
    
        DB::table('category_details')->insert([
            'name' => 'シーンごとに固定',
            'category_name_id'=>1
        ]);
    }
}
