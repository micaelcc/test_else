<?php

namespace App\Helper;

class BaseErrorHandler extends \Exception
{
    public function __construct(string $message, int $status = 500)
    {
        parent::__construct($message, $status, null);
    }

    public function toJson()
    {
        return [
          "error" => $this->message
        ];
    }
}
