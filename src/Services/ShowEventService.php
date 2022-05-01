<?php

namespace App\Services;

use App\Contract\EventRepository;
use App\Entity\Event;
use App\Helper\EventNotFoundError;

class ShowEventService
{
  private EventRepository $eventRepository;

  public function __construct(EventRepository $eventRepository)
  {
    $this->eventRepository = $eventRepository;
  }

  public function execute(int $id): Event
  {
    $event = $this->eventRepository->findById($id);

    if ($event === null) {
      throw new EventNotFoundError();
    }

    return $event;
  }
}