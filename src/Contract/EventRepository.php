<?php

namespace App\Contract;

use App\Entity\Event;

interface EventRepository
{
    public function save(Event $event): void;
    public function findByTitle(string $title): Event | null;
}
