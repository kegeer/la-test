<?php

namespace App\Scholar\Paginate;

use Illuminate\Database\Eloquent\Builder;

class Paginate
{
    /**
     * Total count of the items.
     *
     * @var int
     */
    protected $total;

    /**
     * Collection of items.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $data;

    /**
     * Paginate constructor.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param int $limit
     * @param int $page
     */
    public function __construct(Builder $builder, $limit = 20, $page = 0)
    {
        $limit = request()->get('limit', $limit);

        $page = request()->get('page', $page);

        $this->total = $builder->count();

        $this->data = $builder->latest()->skip($page)->take($limit)->get();
    }

    /**
     * Get the total count of the items.
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Get the paginated collection of items.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getData()
    {
        return $this->data;
    }
}