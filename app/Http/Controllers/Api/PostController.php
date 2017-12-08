<?php

namespace App\Http\Controllers\Api;

use App\Paper;
use App\Post;
use App\Scholar\Paginate\Paginate;
use App\Scholar\Transformers\PostTransformer;
use App\User;
use Illuminate\Http\Request;
//use Illuminate\Http\Response;


class PostController extends ApiController
{
    public function __construct(PostTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function index()
    {
        $posts = new Paginate(Post::query());
//        dd($posts);

        return $this->respondWithPagination($posts);
    }

    public function store(Request $request)
    {
//         $user = auth()->user();
//        $user = auth()->login(User::findOrFail(1));
        auth()->loginUsingId(1);
        $post = Post::create([
            'user_id' => auth()->id(),
            'description' => $request->input('description')
        ]);

        $fileList = $request->input('fileList');

        if ($fileList && ! empty($fileList)) {
            array_map(function($file) use ($post) {
                tap(Paper::find($file['uid']), function ($paper) use ($post) {
                    $paper->post_id = $post->id;
                    $paper->save();
                });
            }, $fileList);
        }

        return $this->respondWithTransformer($post);

    }

    public function show(Post $post)
    {
        return $this->respondWithTransformer($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return $this->respondSuccess();
    }
}