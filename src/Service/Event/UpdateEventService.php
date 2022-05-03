<?php

namespace App\Service\Event;

use App\Contract\EventRepository;
use App\Entity\Event;
use App\Helper\EventNotFoundError;
use App\Dtos\UpdateEventDTO;
use App\Helper\EventTitleAlreadyInUseError;

class UpdateEventService
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function execute(UpdateEventDTO $data, int $id): Event
    {
        $event = $this->eventRepository->findById($id);

        if ($event === null) {
            throw new EventNotFoundError();
        }

        if ($data->title !== null) {
            $eventExists = $this->eventRepository->findByTitle($data->title);

            if ($eventExists !== null && $eventExists->getId() !== $id) {
                throw new EventTitleAlreadyInUseError();
            }

            $event->setTitle($data->title);
        }

        if ($data->description !== null) {
            $event->setDescription($data->description);
        }

        if ($data->start_date !== null) {
            $event->setStartDate(new \DateTime($data->start_date));
        }

        if ($data->end_date !== null) {
            $event->setEndDate(new \DateTime($data->end_date));
        }

        $event->updatedTimestamps();
        $this->eventRepository->save($event);

        return $event;
    }
}
