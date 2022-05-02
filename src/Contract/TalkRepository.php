<?php

namespace App\Contract;

use App\Entity\Talk;

interface TalkRepository
{
    public function save(Talk $talk): void;
    public function findById(int $id): Talk | null;
    public function delete(Talk $talk): void;
    public function findByEvent(int $id);
}
