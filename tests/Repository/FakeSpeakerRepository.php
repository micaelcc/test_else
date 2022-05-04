<?php

namespace App\Tests\Repository;

use App\Contract\SpeakerRepository;
use App\Entity\Speaker;

class FakeSpeakerRepository implements SpeakerRepository
{
  private array $speakers;

  public function __construct()
  {
    $this->speakers = [];
  }

  public function findByEmail(string $email): Speaker | null
  {
    foreach($this->speakers as $speaker) {
      if ($speaker->getEmail() === $email) {
        return $speaker;
      }
    }
    
    return null;
  }

  public function save(Speaker $speaker): void
  {
    $speaker->setId(count($this->speakers) + 1);
    
    $this->speakers[] = $speaker;
  }

  public function findById(int $id): Speaker | null
  {
    foreach($this->speakers as $speaker) {
      if ($speaker->getId() === $id) {
        return $speaker;
      }
    }
    
    return null;
  }
}