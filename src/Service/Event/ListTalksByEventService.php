<?php

namespace App\Service\Event;

use App\Contract\EventRepository;
use App\Contract\TalkRepository;
use App\Helper\EventNotFoundError;

class ListTalksByEventService
{
    private EventRepository $eventRepository;
    private TalkRepository $talkRepository;

    public function __construct(EventRepository $eventRepository, TalkRepository $talkRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->talkRepository = $talkRepository;
    }

    public function execute(int $id): array
    {
        $event = $this->eventRepository->findById($id);

        if ($event === null) {
            throw new EventNotFoundError();
        }

        $eventTalks = $this->talkRepository->findByEvent($id);

        $talks = [];

        foreach ($eventTalks as $talk) {
            $talks[] = $talk->toJson();
        }

        return $talks;
    }
}
