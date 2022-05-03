<?php

namespace App\Helper;

use App\Helper\BaseErrorHandler;

class EventAlreadyExistsError extends BaseErrorHandler
{
    public function __construct()
    {
        parent::__construct('event already exists', 409);
    }
}
