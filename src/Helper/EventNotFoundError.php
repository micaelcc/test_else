<?php

namespace App\Helper;

use App\Helper\BaseErrorHandler;

class EventNotFoundError extends BaseErrorHandler
{
    public function __construct()
    {
        parent::__construct('event not found', 404);
    }
}
