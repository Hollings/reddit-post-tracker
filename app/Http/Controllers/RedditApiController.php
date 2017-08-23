<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reddit;
use Charts;

class RedditApiController extends Controller
{
    public function index(Request $request){

        // Get vars from the url. 
        $sub = $request->sub??$_GET['sub']??'all';
        $count = $request->count??$_GET['count']??10000;

    	$r = new Reddit;

        // Get list of n 'hot' posts.
    	$response = $r->getListing( $sub, $count);

        // If API doesn't return what we want, just output the raw response
        if (is_null($response->data??null)){
            return json_encode($response);
        }

        // Parse response into a simple [x,y] format
        $voteData = [];
    	foreach ($response->data->children as $key => $child) {
            
            // We don't want sticky posts
        	if ($child->data->stickied) {
        		continue;
    		}
    		$votes = $child->data->score; //ups?
    		$comments = $child->data->num_comments;
            $link = $child->data->permalink;
            $title = $child->data->title;
    		$voteData[] = ['votes'=>$votes,'comments'=>$comments,'link'=>$link,'title'=>$title];
    	}

    	return view('reddit.chart',compact(['voteData','sub']));
    }

    // public function getRedditPostVsCommentData($sub, $)
}
