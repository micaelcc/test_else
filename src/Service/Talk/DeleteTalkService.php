<?php

namespace App\Service\Talk;

use App\Contract\TalkRepository;
use App\Helper\TalkNotFoundError;

class DeleteTalkService
{
    private TalkRepository $talkRepository;

    public function __construct(TalkRepository $talkRepository)
    {
        $this->talkRepository = $talkRepository;
    }

    public function execute(int $id): void
    {
        $talk = $this->talkRepository->findById($id);

        if ($talk === null) {
            throw new TalkNotFoundError();
        }

        $this->talkRepository->delete($talk);
    }
}
