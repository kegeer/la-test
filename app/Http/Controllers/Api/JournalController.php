<?php

namespace App\Http\Controllers\Api;

use App\Journal;
use App\Scholar\Paginate\Paginate;
use App\Scholar\Transformers\JournalTransformer;
use Illuminate\Http\Request;

class JournalController extends ApiController
{
    public function __construct(JournalTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function index()
    {
        $journals = new Paginate(Journal::query());
        return $this->respondWithPagination($journals);
    }
}
