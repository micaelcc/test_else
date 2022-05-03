<?php

namespace App\Service\Talk;

use App\Entity\Talk;
use App\Dtos\CreateTalkDTO;
use App\Contract\EventRepository;
use App\Contract\TalkRepository;
use App\Contract\SpeakerRepository;
use App\Helper\SpeakerNotFoundError;
use App\Helper\EventNotFoundError;

class CreateTalkService
{
    private TalkRepository $talkRepository;
    private EventRepository $eventRepository;
    private SpeakerRepository $speakerRepository;

    public function __construct(
        TalkRepository $talkRepository,
        EventRepository $eventRepository,
        SpeakerRepository $speakerRepository
    ) {
        $this->talkRepository = $talkRepository;
        $this->eventRepository = $eventRepository;
        $this->speakerRepository = $speakerRepository;
    }

    public function execute(CreateTalkDTO $data): Talk
    {
        $eventExists = $this->eventRepository->findById($data->event_id);

        if ($eventExists === null) {
            throw new EventNotFoundError();
        }

        $speakerExists = $this->speakerRepository->findById($data->speaker_id);

        if ($speakerExists === null) {
            throw new SpeakerNotFoundError();
        }

        $talk = new Talk();

        $date = new \DateTime($data->date);

        $talk->setTitle($data->title);
        $talk->setDate($date);
        $talk->setSpeaker($speakerExists);
        $talk->setStartTime($data->start_time);
        $talk->setEndTime($data->end_time);
        $talk->setDescription($data->description);
        $talk->setEvent($eventExists);

        $this->talkRepository->save($talk);

        return $talk;
    }
}
