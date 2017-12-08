<?php

namespace App\Http\Controllers\Api;

use App\Paper;
use App\Scholar\Paginate\Paginate;
use App\Scholar\Transformers\PaperTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PaperController extends ApiController
{


    /**
     * FeedController constructor.
     *
     * @param PostTransformer $transformer
     */
    public function __construct(PaperTransformer $transformer)
    {
        $this->transformer = $transformer;

    }

    public function index()
    {
//        $papers = Paper::all();
//        dd($papers);
        $papers = new Paginate(Paper::query());

        return $this->respondWithPagination($papers);
    }

    public function add(Request $request)
    {
        $file = $request->file('file');
        // dd($file);
        $uf = sha1(time(). uniqid());
        $file->move(storage_path('app/public'), $uf);
        $paper = Paper::create([
            'mime' => $file->getClientMimeType(),
            'original_filename' => $file->getClientOriginalName(),
            'filename' => $uf,
        ]);
        return $this->respondWithTransformer($paper);
    }

    public function show($filename)
    {
        $filename = $filename;
        $paper = Paper::where('filename', '=', $filename)->firstOrFail();
//        dd($paper);
        $file = Storage::disk('public')->get($paper->filename);
        // $file_content = chunk_split(base64_encode(($file)));
        // dd($file_content);
        // return (new Response($file_content, 200))

        return (new Response($file, 200))
            ->header('Content-Type', $paper->mime);
            // ->header('Content-Type', 'text/plain; charset=utf-8');

    }

    public function getAnnotations(Paper $paper)
    {
        return $this->respondWithTransformer($paper->annotations()->get());
    }
}