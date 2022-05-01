<?php

namespace App\Dtos;

use Spatie\DataTransferObject\DataTransferObject;

class CreateEventDTO extends DataTransferObject
{
    public string $title;
    public DateTime | string $start_date;
    public DateTime | string $end_date;
    public string $description;
    public string $status;
}
