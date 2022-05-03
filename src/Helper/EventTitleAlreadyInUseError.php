<?php

namespace App\Helper;

use App\Helper\BaseErrorHandler;

class EventTitleAlreadyInUseError extends BaseErrorHandler
{
    public function __construct()
    {
        parent::__construct('event with that title already exists', 409);
    }
}
