<?php

namespace App\Scholar\Transformers;

class AnnotationTransformer extends Transformer
{
    protected $resourceName = 'annotation';

    public function transform($data)
    {
        return [
            'id' => $data['id'],
            'title'  => $data['title'],
            'body'  => $data['body'],
//            'paper'  => $data['paper'],
            'selectors'  => $data['selectors'],
//            'comments'  => $data['comments'],
//            'tagsList'  => $data['tagsList'],
           'createdAt'             => $data['created_at']->toAtomString(),
            'updatedAt'             => $data['updated_at']->toAtomString(),
        ];
    }
}