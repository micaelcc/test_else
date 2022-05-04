<?php

namespace App\Tests;

use App\Contract\EventRepository;
use App\Entity\Event;

class FakeEventRepository implements EventRepository
{
  private array $events;
  
  public function __construct()
  {
    $this->events = [];
  }
  
  public function save(Event $event): void
  {
    $event->setId(count($this->events) + 1);

    $events[] = $event;
  }

  public function findByTitle(string $title): Event | null
  {
    return null;
  }
  public function findById(int $id): Event | null
  {
    return null;
  }

  public function delete(Event $event): void
  {
    return;
  }
}