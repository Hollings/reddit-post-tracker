<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostwatcherPosthistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_watchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reddit_id')->nullable();
            $table->string('reddit_permalink')->nullable();
            $table->integer('starting_karma')->default(0);
            $table->integer('current_karma')->default(0);
            $table->timestamps();
        });


        // We could store the entire reddit JSON, but 
        // we'll just choose these few data points
        Schema::create('post_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_watcher_id')->unsigned()->nullable();
            $table->integer('score')->default(0);
            $table->string('num_comments')->default(0);
            $table->integer('guilded')->default(0);
            $table->float('upvote_ratio')->default(0);
             $table->foreign('post_watcher_id')
              ->references('id')->on('post_watchers')
              ->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_histories');
        Schema::drop('post_watchers');
    }
}
