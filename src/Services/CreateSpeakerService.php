<?php

namespace App\Services;

use App\Contract\SpeakerRepository;
use App\Dtos\CreateSpeakerDTO;
use App\Entity\Speaker;
use App\Helper\SpeakerAlreadyExistsError;

class CreateSpeakerService
{
    private SpeakerRepository $speakerRepository;

    public function __construct(SpeakerRepository $speakerRepository)
    {
        $this->speakerRepository = $speakerRepository;
    }

    public function execute(CreateSpeakerDTO $data): Speaker
    {
        $speakerAlreadyExists = $this->speakerRepository->findByEmail($data->email);

        if ($speakerAlreadyExists) {
            throw new SpeakerAlreadyExistsError();
        }

        $speaker = new Speaker();

        $speaker->setName($data->name);
        $speaker->setEmail($data->email);

        $this->speakerRepository->save($speaker);

        return $speaker;
    }
}
