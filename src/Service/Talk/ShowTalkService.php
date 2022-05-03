<?php

namespace App\Service\Talk;

use App\Contract\TalkRepository;
use App\Entity\Talk;
use App\Helper\TalkNotFoundError;

class ShowTalkService
{
    private TalkRepository $talkRepository;

    public function __construct(TalkRepository $talkRepository)
    {
        $this->talkRepository = $talkRepository;
    }

    public function execute(int $id): Talk
    {
        $talk = $this->talkRepository->findById($id);

        if ($talk === null) {
            throw new TalkNotFoundError();
        }

        return $talk;
    }
}
