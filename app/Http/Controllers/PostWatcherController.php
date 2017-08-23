<?php

namespace App\Http\Controllers;

use App\PostWatcher;
use App\PostHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PostWatcherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($all = null)
    {
        // $p = PostWatcher::first();
        // return json_encode($p->getCurrentData());
        $date = new Carbon; //  DateTime string will be 2014-04-03 13:57:34
        if (!is_null($all)) {
            $postWatchers = PostWatcher::orderBy('current_karma','desc')->get();
        } else {
            $date->subDays(1); // or $date->subDays(7),  2014-03-27 13:58:25
            $postWatchers = PostWatcher::orderBy('current_karma','desc')->where('created_at', '>', $date->toDateTimeString() )->get();
        }


        return view('reddit.home',compact(['postWatchers']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = new PostWatcher;
        $p->reddit_permalink = $request->permalink;
        $p->save();
        //$p->posthistory()->save($h);

        // $postWatchers = PostWatcher::with('posthistory')->all();
        return $p->id;
    }

    public function byIdTest()
    {
        $p = new PostWatcher;
        $response = $p->byId(["t3_6d9fjg","t3_6dbrrp","t3_6dbatq","t3_6dcjw1","t3_6cbo1d","t3_6dcy9g","t3_6dob5f1"]);
        return $response;
    }

    public function redditurltest($subreddit, $reddit_id, $extra_url){
        $postWatcher = PostWatcher::getOrCreatePostWatcherFromRedditId($reddit_id);
        return view('reddit.viewpost',compact(['postWatcher']));
    }

   


    public function saveRandomIdsFromRising()
    {
        PostWatcher::getRandomIdFromRising();
        return "true";
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\PostWatcher  $postWatcher
     * @return \Illuminate\Http\Response
     */
    public function show(PostWatcher $postWatcher)
    {
        return view('reddit.viewpost',compact(['postWatcher']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostWatcher  $postWatcher
     * @return \Illuminate\Http\Response
     */
    public function edit(PostWatcher $postWatcher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostWatcher  $postWatcher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostWatcher $postWatcher)
    {
        $p = PostWatcher::first();
        $p->getCurrentData();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostWatcher  $postWatcher
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostWatcher $postWatcher)
    {
        //
    }

    public function frontPage()
    {
        $r = PostWatcher::frontPage();
        return $r;
    }
}
