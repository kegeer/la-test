<?php

namespace App\Http\Controllers\Api;

use App\Scholar\Paginate\Paginate;
use App\Scholar\Transformers\AnnotationTransformer;
use Illuminate\Http\Request;

class FeedController extends ApiController
{
    public function __construct(AnnotationTransformer $transformer)
    {
        $this->transformer = $transformer;
        $this->middleware('auth.api');
    }

    public function index()
    {
        $user = auth()->user();

        $annotations = new Paginate($user->feed());

        return $this->respondWithPagination($annotations);
    }
}
