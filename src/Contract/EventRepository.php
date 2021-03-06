<?php

namespace App\Contract;

use App\Entity\Event;

interface EventRepository
{
    public function save(Event $event): void;
    public function findByTitle(string $title): Event | null;
    public function findById(int $id): Event | null;
    public function delete(Event $event): void;
}
