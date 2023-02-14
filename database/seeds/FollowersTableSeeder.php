<?php

use Illuminate\Database\Seeder;
use App\Models\Follower;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 10; $i++) {
            Follower::create([
                'following_id' => 1,
                'followed_id' => $i
            ]);
        }
    }
}

/*ユーザID1を各ユーザがフォロー*/