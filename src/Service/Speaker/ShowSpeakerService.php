<?php

namespace App\Service\Speaker;

use App\Contract\SpeakerRepository;
use App\Entity\Speaker;
use App\Helper\SpeakerNotFoundError;
use App\Contract\TalkRepository;

class ShowSpeakerService
{
    private SpeakerRepository $speakerRepository;
    private TalkRepository $talkRepository;

    public function __construct(SpeakerRepository $speakerRepository, TalkRepository $talkRepository)
    {
        $this->speakerRepository = $speakerRepository;
        $this->talkRepository = $talkRepository;
    }

    public function execute(int $id): Speaker
    {
        $speaker = $this->speakerRepository->findById($id);

        if ($speaker === null) {
            throw new SpeakerNotFoundError();
        }
        return $speaker;
    }
}
