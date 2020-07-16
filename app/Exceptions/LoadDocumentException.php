<?php

namespace App\Exceptions;

class LoadDocumentException extends \Exception
{
    public function render($request)
    {
        return $this->response ?? response()->json([
                'errors' => [
                    'url' => [
                        'Can\'t find url. Please try later or check yours input'
                    ]
                ]
            ])->setStatusCode(404);
    }
}
