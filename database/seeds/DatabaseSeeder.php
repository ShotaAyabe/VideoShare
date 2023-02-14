<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            FollowersTableSeeder::class,
        ]);
    }
}

/*$this->call()の中で上から順に実行されるため
この並びでないとテーブルの親子関係上エラーになる*/