<?php

namespace App\Helper;

use App\Helper\BaseErrorHandler;

class StartDateAndEndDateError extends BaseErrorHandler
{
    public function __construct()
    {
        parent::__construct('start date must be before end date', 400);
    }
}
