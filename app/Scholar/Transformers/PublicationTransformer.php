<?php

namespace App\Scholar\Transformers;

class PublicationTransformer extends Transformer
{
    protected $resourceName = 'post';

    public function transform($data)
    {
        return [
            'id'                => $data['id'],
            'title'             => $data['title'],
            'abstract'          => $data['abstract'],
            'tagsList'           => $data['tagsList'],
            'authorsList'        => $data['authorsList'],
            'annotationsCount'   => $data['annotationsCount'],
//            'publishedAt'        => $data['published_at']->toAtomString(),
            'createdAt'         => $data['created_at']->toAtomString(),
            'updatedAt'         => $data['updated_at']->toAtomString(),
            'favorited'         => $data['favorited'],
            'favoritesCount'    => $data['favoritesCount'],
            'journal' => [
                'id'            => $data['journal']['id'],
                'title'         => $data['journal']['title'],
                'issn'          => $data['journal']['issn']
            ]
        ];
    }
}