<?php

namespace App\Scholar\Transformers;

class AuthorTransformer extends Transformer
{
    protected $resourceName = 'author';

    public function transform($data)
    {
        return [
            'firstName'       => $data['first_name'],
            'lastName'     => $data['last_name'],
            'fullName' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
        ];
    }
}