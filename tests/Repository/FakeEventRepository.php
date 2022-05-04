<?php

namespace App\Tests\Repository;

use App\Contract\EventRepository;
use App\Entity\Event;

class FakeEventRepository implements EventRepository
{
  public array $events;
  
  public function __construct()
  {
    $this->events = [];
  }
  
  public function save(Event $event): void
  {
    $event->setId(count($this->events) + 1);

    $this->events[] = $event;
  }

  public function findByTitle(string $title): Event | null
  {
    foreach($this->events as $event) {
      if ($event->getTitle() === $title) {
        return $event;
      }
    }

    return null;
  }

  public function findById(int $id): Event | null
  {
    foreach($this->events as $event) {
      if ($event->getId() === $id) {
        return $event;
      }
    }

    return null;
  }

  public function delete(Event $event): void
  {
    return;
  }
}