@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <table class="post-table table table-striped" cellspacing="0">
                <thead>
                <tr><th>Link</th><th>Title</th>{{-- <th>Starting K</th> --}}<th>Score Change</th>{{-- <th>Change</th> --}}<th></th></tr>

                
                </thead>
                <tfoot>
                <tr><th>Link</th><th>Title</th>{{-- <th>Starting K</th> --}}<th>Score Change<</th>{{-- <th>Change</th> --}}<th></th></tr>

              
                </tfoot>
                <tbody>
                     @foreach ($postWatchers as $pw)
                <tr @if($pw->interesting) class="int" @endif>
                        <td><a href="http://reddit.com{{ $pw->reddit_permalink }}">{{ explode("/",$pw->reddit_permalink)[2]??"" }}</a></td>
                        <td>{{ (strlen($pw->title) > 50 ? substr($pw->title,0,50)."..." : $pw->title) }}</td>
                        
                        {{-- <td>{{$pw->starting_karma}}</td> --}}
                        <td>{{$pw->current_karma - $pw->starting_karma}}</td>
                        {{-- <td>{{$pw->current_karma - $pw->starting_karma}}</td> --}}
                        

                        <td><a href="{{ $pw->reddit_permalink }}">View Chart</a></td>
                </tr>
                        {{--<table class="table table-bordered">
                        <tbody>
                        <tr><th>Time</th><th>Points</th></tr>
                        @foreach ($pw->posthistory as $ph)
                            <tr>
                            <td>{{$ph->created_at}}</td>
                            <td>{{$ph->score}}</td></tr>
                        @endforeach
                        </tbody>
                        </table>--}}
                    @endforeach
                      </tbody></table>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="color: black;">
        <h3>What is this?</h3>
        <p>This site tracks the current score and number of comments of reddit posts.</p>
        <p>The program selects 5 random posts from <b>/r/all/new</b> and <b>/r/all/rising</b> every hour, and updates the current score every minute for 24 hours. New posts can be manually added by replacing "reddit.com" with "hollings.io" on any reddit url.</p>
        <p>If a post doesn't reach a certain score threshold within an hour, it is no longer tracked in the system. </p>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<style type="text/css">
    tr.int {
    background-color: #fffbcb!important;
}
</style>
<script>
$(document).ready(function() {
    $('.post-table').DataTable({
        "paging":   false,
        "info":     false,
        "order": [[ 3, "desc" ]]
    });
} );
</script>
@endsection
