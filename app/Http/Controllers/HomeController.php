<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\LastestPost;
use App\Events\NewestPost;
use App\Post;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home');
    }


    public function posts()
    {
        $posts = Post::orderBy('id', 'desc')->take('10')->get();

        $post_box = [];
        foreach ($posts as $post) {
            # code...

            $data = array(
                'username' => 'delino',
                'body' => $post->body,
                'date' => $post->created_at->diffForHumans()
            );

            array_push($post_box, $data);
        }

        return response()->json($post_box);
    }

    public function saveNews(Request $request)
    {
        // news inputs
        $username = 'dino';
        $user = 1;
        $body = $request->body;

        $news = new Post();
        $news->user_id = $user;
        $news->body = $body;
        $news->save();

        $time = Post::where('body', $body)->first();
        $date = $time->created_at->diffForHumans();

        // call events
        \Event::fire(new NewestPost($username, $body, $date));

        $msg = " post sent !";
        echo $msg;
    }

    // Json
    public function allNews()
    {
        // fetch all posts
        $all_posts = Post::orderBy('id', 'desc')->get();

        $news_box = [];
        // push to API
        foreach ($all_posts as $posts) {
            // get rand title
            $titles = ['delino', 'matthew', 'sammuel', 'soben', 'soso'];
            $mag = mt_rand(0, count($titles) - 1);
            $pin_tile = $titles[$mag];
            
            # code...
            $data = array(
                'title' => $pin_tile,
                'body'  => $posts->body,
                'date'  => $posts->created_at->diffForHumans()
            );

            array_push($news_box, $data);
        }

        return response()->json($news_box);
    }


}

