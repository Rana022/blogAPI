<?php

namespace App\Exceptions;

use Exception;

class AuthorNotBelongsTo extends Exception
{
    public function render()
    {
        return ['error' => 'Author not Belongs to this'];
    }
}
