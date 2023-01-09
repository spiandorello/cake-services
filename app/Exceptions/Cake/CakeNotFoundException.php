<?php

namespace App\Exceptions\Cake;

use Exception;
use Illuminate\Http\Response;

class CakeNotFoundException extends Exception
{
    const MESSAGE = 'This cake not exist!';

    public function __construct()
    {
        parent::__construct(
            message: self::MESSAGE,
            code: Response::HTTP_NOT_FOUND,
        );
    }
}
