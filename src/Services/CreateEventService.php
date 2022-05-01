<?php

namespace App\Services;

use App\Contract\EventRepository;
use App\Dtos\CreateEventDTO;
use App\Entity\Event;
use App\Helper\EventAlreadyExistsError;
use App\Helper\StartDateAndEndDateError;

class CreateEventService
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function execute(CreateEventDTO $data): Event
    {
        $eventAlreadyExists = $this->eventRepository->findByTitle($data->title);

        if ($eventAlreadyExists) {
            throw new EventAlreadyExistsError();
        }

        $start_date = new \DateTime($data->start_date);
        $end_date = new \DateTime($data->end_date);

        if ($start_date >= $end_date) {
            throw new StartDateAndEndDateError();
        }

        $event = new Event();

        $event->setTitle($data->title);
        $event->setStartdate($start_date);
        $event->setEndDate($end_date);
        $event->setDescription($data->description);
        $event->setStatus($data->status);

        $this->eventRepository->save($event);

        return $event;
    }
}
