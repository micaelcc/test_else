<?php

namespace App\Services;

use App\Contract\SpeakerRepository;
use App\Contract\TalkRepository;
use App\Helper\SpeakerNotFoundError;

class ListTalksBySpeakerService
{
    private SpeakerRepository $speakerRepository;
    private TalkRepository $talkRepository;

    public function __construct(SpeakerRepository $speakerRepository, TalkRepository $talkRepository)
    {
        $this->speakerRepository = $speakerRepository;
        $this->talkRepository = $talkRepository;
    }

    public function execute(int $id): array
    {
        $speaker = $this->speakerRepository->findById($id);

        if ($speaker === null) {
            throw new SpeakerNotFoundError();
        }

        $speakerTalks = $this->talkRepository->findBySpeaker($id);

        $talks = [];

        foreach ($speakerTalks as $talk) {
            $talks[] = $talk->toJson();
        }

        return $talks;
    }
}
