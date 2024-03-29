<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('ユーザID');
            $table->string('url')->comment('共有したい動画URL');
            $table->string('text')->comment('本文');
            $table->softDeletes();
            $table->timestamps();
            
            $table->index('id');
            $table->index('user_id');
            $table->index('text');
/*新たに動画詳細情報カラムを追加*/
            $table->string('thumbnail')->comment('サムネイル画像');
            $table->string('title')->comment('動画タイトル');
            $table->string('author')->comment('チャンネル名');
            
/*Userテーブルと外部キー接続を宣言*/
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}