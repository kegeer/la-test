<?php

namespace App\Scholar\Transformers;

class PostTransformer extends Transformer
{
    protected $resourceName = 'post';

    public function transform($data)
    {
        return [
            'id'                    => $data['id'],
            'description'           => $data['description'],
            'createdAt'             => $data['created_at']->toAtomString(),
            'updatedAt'             => $data['updated_at']->toAtomString(),
            'papers'                => $data['papers'],
            'author' => [
                'id'                => $data['user']['id'],
                'username'          => $data['user']['username'],
                'email'          => $data['user']['email'],
                'image'          => $data['user']['image'],
            ]
        ];
    }
}