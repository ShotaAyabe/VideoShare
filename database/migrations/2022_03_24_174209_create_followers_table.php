<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->unsignedInteger('following_id')->comment('フォローしているユーザID');
            $table->unsignedInteger('followed_id')->comment('フォローされているユーザID');

            $table->index('following_id');
            $table->index('followed_id');
   /*uniqueの登録で以下のキーの組み合わせで
     同じIDの登録を防ぐことができる*/
            $table->unique([
                'following_id',
                'followed_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}

/*
自分がフォローしているユーザのツイートを
TLに表示するときは自分がfollowing_idで
相手がfollowed_idになる。     
*/