<?php

namespace App\Helper;

class SpeakerAlreadyExistsError extends \Exception
{
    public function __construct()
    {
        parent::__construct('speaker already exists', 409, null);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
