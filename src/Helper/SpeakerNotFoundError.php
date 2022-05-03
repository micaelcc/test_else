<?php

namespace App\Helper;

use App\Helper\BaseErrorHandler;

class SpeakerNotFoundError extends BaseErrorHandler
{
    public function __construct()
    {
        parent::__construct('speaker not found', 404);
    }

}
