<?php

namespace App\Http\Controllers\Api;

use App\Publication;
use App\Scholar\Transformers\PublicationTransformer;
use Illuminate\Http\Request;

class FavoriteController extends ApiController
{
    public function __construct(PublicationTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api');
    }

    public function add(Publication $publication)
    {
        $user = auth()->user();
        $user->favorite($publication);

        return $this->respondWithTransformer($publication);
    }

    /**
     * unfavorite the publication given by its id and return the publication if successful
     * @param Publication $publication
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Publication $publication)
    {
        $user = auth()->user();

        $user->unFavorite($publication);

        return $this->respondWithTransformer($publication);
    }
}

