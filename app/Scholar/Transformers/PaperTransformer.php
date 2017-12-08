<?php

namespace App\Scholar\Transformers;

class PaperTransformer extends Transformer
{
    protected $resourceName = 'paper';

    public function transform($data)
    {
        return [
            'id' => $data['id'],
            'mime' => $data['mime'],
            'filename' => $data['filename'],
            'originalFilename' => $data['original_filename'],
            'annnotations' => $data['annotations']
//            'path' => $data['path']
        ];
    }
}