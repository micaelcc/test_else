<?php

namespace App\Dtos;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateEventDTO extends DataTransferObject
{
    public string | null $title;
    public string | null $start_date;
    public string | null $end_date;
    public string | null $description;
}
