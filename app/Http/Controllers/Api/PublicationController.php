<?php

namespace App\Http\Controllers\Api;

use App\Publication;
use App\Scholar\Filters\PublicationFilter;
use App\Scholar\Paginate\Paginate;
use App\Scholar\Transformers\PublicationTransformer;
use Illuminate\Http\Request;

class PublicationController extends ApiController
{
    public function __construct(PublicationTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api')->except(['index', 'show']);

        $this->middleware('auth.api:optional')->only(['index', 'show']);
    }

    public function index(PublicationFilter $filter)
    {
        $publications = new Paginate(Publication::loadRelations()->filter($filter));

        return $this->respondWithPagination($publications);
    }

//    public function store(CreatePublication $request)
//    {
//        $user = auth()->user();
//
//        $publication = $user->
//    }

    public function show(Publication $publication)
    {
        return $this->respondWithTransformer($publication);
    }




}
