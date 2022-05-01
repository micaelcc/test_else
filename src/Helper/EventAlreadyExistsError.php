<?php

namespace App\Helper;

class EventAlreadyExistsError extends \Exception
{
    public function __construct()
    {
        parent::__construct('event already exists', 409, null);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
