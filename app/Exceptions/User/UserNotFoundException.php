<?php

namespace App\Exceptions\User;

use Exception;
use Illuminate\Http\Response;

class UserNotFoundException extends Exception
{
    const MESSAGE = 'This user not exist!';

    public function __construct()
    {
        parent::__construct(
            message: self::MESSAGE,
            code: Response::HTTP_NOT_FOUND,
        );
    }
}