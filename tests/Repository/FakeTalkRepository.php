<?php

namespace App\Tests\Repository;

use App\Contract\TalkRepository;
use App\Entity\Talk;

class FakeTalkRepository implements TalkRepository
{
  private $talks;

  public function __construct()
  {
    $this->talks = [];
  }

  public function findById(int $id): Talk | null
  {
    foreach($this->talks as $talk) {
      if ($talk->getId() === $id) {
        return $talk;
      }
    }

    return null;
  }
  
  public function save(Talk $talk): void
  {
    $talk->setId(count($this->talks) + 1);

    $this->talks[] = $talk;
  }

  public function delete(Talk $talk): void
  {

  }

  public function findByEvent(int $id)
  {
    return [];
  }

  public function findBySpeaker(int $id)
  {
    return [];
  }
}