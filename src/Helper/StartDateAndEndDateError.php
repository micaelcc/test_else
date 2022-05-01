<?php

namespace App\Helper;

class StartDateAndEndDateError extends \Exception
{
    public function __construct()
    {
        parent::__construct('start date must be before end date', 400, null);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
