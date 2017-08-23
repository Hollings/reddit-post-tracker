<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFpData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_histories', function (Blueprint $table) {
            $table->boolean('on_front_page')->default(false);
        });
        Schema::table('post_watchers', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('thumbnail')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
