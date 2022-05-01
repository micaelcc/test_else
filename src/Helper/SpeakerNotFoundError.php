<?php

namespace App\Helper;

class SpeakerNotFoundError extends \Exception
{
    public function __construct()
    {
        parent::__construct('speaker not found', 404, null);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
