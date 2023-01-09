<?php

namespace App\Exceptions\CakeSubscriber;

use Exception;
use Illuminate\Http\Response;

class CakeUserAlreadySubscribedException extends Exception
{
    const MESSAGE = 'This user already subscribed in this cake!';

    public function __construct()
    {
        parent::__construct(
            message: self::MESSAGE,
            code: Response::HTTP_BAD_REQUEST,
        );
    }
}
