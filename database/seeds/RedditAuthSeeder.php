<?php

use Illuminate\Database\Seeder;

class RedditAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reddit_auths')->truncate();
         DB::table('reddit_auths')->insert([
            'access_token' => "z03QX81wdRSS6Ajb5JdxUSk7tjA",
            'token_type' => 'bearer',
            'expires_in' => 0,
            'refresh_token' => null
        ]);
    }
}
