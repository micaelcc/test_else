<?php

namespace App\Dtos;

use Spatie\DataTransferObject\DataTransferObject;

class CreateTalkDTO extends DataTransferObject
{
    public string $title;
    public string $date;
    public int $event_id;
    public string $start_time;
    public string $end_time;
    public string $description;
    public int $speaker_id;
}
