<?php

namespace App\Helper;

use App\Helper\BaseErrorHandler;

class SpeakerAlreadyExistsError extends BaseErrorHandler
{
    public function __construct()
    {
        parent::__construct('speaker already exists', 409);
    }
}
