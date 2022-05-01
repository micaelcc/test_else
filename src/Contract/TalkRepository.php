<?php

namespace App\Contract;

use App\Entity\Talk;

interface TalkRepository
{
    public function save(Talk $talk): void;
}
