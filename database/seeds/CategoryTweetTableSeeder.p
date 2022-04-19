<?php

use Illuminate\Database\Seeder;

class CategoryTweetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_tweet')->insert([
            'tweet_id' => '1',
            'category_detail_id' => '2',

        ]);
    

    
    }
}
