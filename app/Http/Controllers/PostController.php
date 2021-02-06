<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PostController extends Controller
{
    public function index()
    {
        $tag_id = "laravel";

        $url = "https://qiita.com/api/v2/tags/" . $tag_id . "/items?page=1&per_page=20";
        $method = "GET";

        // 接続
        $client = new Client();

        $response = $client->request($method, $url);

        $posts = $response->getBody();
        $posts = json_decode($posts, true);

        return view('index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('form');
    }

    public function send(Request $request)
    {
        $url = 'https://qiita.com/api/v2/items';
        $mthod = "POST";
        $token = env('QIITA_TOKEN_NO');

        $data = array(
            "title" => $request->title,
            "body" => $request->body,
            "private" => $request->private === 'private' ? true : false,
            "tags" => [
                [
                    'name' => $request->tag,
                ]
            ],
        );

        $client = new Client();

        $options = [
            'json' => $data,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ]
        ];

        $response = $client->request($mthod, $url, $options);

        $post = $response->getBody();
        $post = json_decode($post, true);

        // レスポンスから新規記事のURLを取得
        $new_post_url = $post['url'];

        return redirect('/create')->with('flash_message', '<a href=' . $new_post_url . '>記事</a>を投稿しました');
    }
}
