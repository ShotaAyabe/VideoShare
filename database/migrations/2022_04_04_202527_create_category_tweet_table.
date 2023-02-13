<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTweetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_tweet', function (Blueprint $table) {
            $table->Increments('id');
            $table->timestamps();
 
            $table->unsignedInteger('tweet_id')->comment('ツイートID');
            $table->unsignedInteger('category_detail_id')->comment('カテゴリー詳細ID');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_tweet');
    }
}