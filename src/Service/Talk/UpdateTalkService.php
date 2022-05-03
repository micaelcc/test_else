<?php

namespace App\Service\Talk;

use App\Contract\TalkRepository;
use App\Entity\Talk;
use App\Helper\TalkNotFoundError;
use App\Helper\SpeakerNotFoundError;
use App\Dtos\UpdateTalkDTO;
use App\Contract\SpeakerRepository;

class UpdateTalkService
{
    private TalkRepository $talkRepository;
    private SpeakerRepository $speakerRepository;

    public function __construct(TalkRepository $talkRepository, SpeakerRepository $speakerRepository)
    {
        $this->talkRepository = $talkRepository;
        $this->speakerRepository = $speakerRepository;
    }

    public function execute(UpdateTalkDTO $data, int $id): Talk
    {
        $talk = $this->talkRepository->findById($id);

        if ($talk === null) {
            throw new TalkNotFoundError();
        }

        if ($data->speaker_id !== null) {
            $speaker = $this->speakerRepository->findById($data->speaker_id);

            if ($speaker === null) {
                throw new SpeakerNotFoundError();
            }

            $talk->setSpeaker($speaker);
        }

        if ($data->description !== null) {
            $talk->setDescription($data->description);
        }

        if ($data->title !== null) {
            $talk->setTitle($data->title);
        }

        if ($data->start_time !== null) {
            $talk->setStartTime($data->start_time);
        }

        if ($data->end_time !== null) {
            $talk->setEndTime($data->end_time);
        }

        if ($data->date !== null) {
            $talk->setDate(new \DateTime($data->date));
        }

        $talk->updatedTimestamps();

        $this->talkRepository->save($talk);

        return $talk;
    }
}
