<?php

namespace App\Scholar\Transformers;

class TagTransformer extends Transformer
{
    protected $resourceName = 'tag';

    public function transform($data)
    {
        return $data;
    }
}