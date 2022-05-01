<?php

namespace App\Dtos;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateTalkDTO extends DataTransferObject
{
    public string | null $title;
    public string | null $description;
    public string | null $date;
    public int | null $speaker_id;
    public string | null $start_time;
    public string | null $end_time;
}
