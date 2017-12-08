<?php

namespace App\Http\Controllers\Api;

use App\Scholar\Transformers\AnnotationTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paper;
use App\Annotation;

class AnnotationController extends ApiController
{

    public function __construct(AnnotationTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function index($filename)
    {
        $annotations = Paper::where('filename', $filename)->first()->annotations()->get();
//        if ($paper) {
//            $annotations = $paper->annotations;
//        }
//        dd($annotations);
//        $annotations = $paper->annotations()->get();
        return $this->respondWithTransformer($annotations);
    }

    public function store(Request $request)
    {
        $filename = $request->input('filename');
        $paper = Paper::where('filename', $filename)->first();
        $annotation = $paper->annotations()->create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'selectors' => json_encode($request->input('selectors')),
        ]);

        return $this->respondWithTransformer($annotation);
    }

    public function show(Annotation $annotation)
    {
        return $this->respondWithTransformer($annotation);
    }
}
