<?php

namespace App\Service\Event;

use App\Contract\EventRepository;
use App\Helper\EventNotFoundError;

class DeleteEventService
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function execute(int $id): void
    {
        $event = $this->eventRepository->findById($id);

        if ($event === null) {
            throw new EventNotFoundError();
        }

        $this->eventRepository->delete($event);
    }
}
