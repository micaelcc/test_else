<?php

namespace App\Dtos;

use Spatie\DataTransferObject\DataTransferObject;

class CreateSpeakerDTO extends DataTransferObject
{
    public string $name;
    public string $email;
}
