<?php

namespace App\Scholar\Transformers;

class JournalTransformer extends Transformer
{
    protected $resourceName = 'journal';

    public function transform($data)
    {
        return [
            'title'     => $data['title'],
            'issn'      => $data['issn'],
        ];
    }
}