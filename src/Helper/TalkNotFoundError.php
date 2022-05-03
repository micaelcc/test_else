<?php

namespace App\Helper;

use App\Helper\BaseErrorHandler;

class TalkNotFoundError extends BaseErrorHandler
{
    public function __construct()
    {
        parent::__construct('talk not found', 404);
    }
}
