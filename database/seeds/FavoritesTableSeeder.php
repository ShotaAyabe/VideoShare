<?php

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 10; $i++) {
            Favorite::create([
                'user_id' => 1,
                'tweet_id' => $i
            ]);
        }
    }
}

/*ユーザID1が自分を除くツイートに対して1ついいねを付ける*/