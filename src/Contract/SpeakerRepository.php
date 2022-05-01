<?php

namespace App\Contract;

use App\Entity\Speaker;

interface SpeakerRepository
{
  public function findByEmail(string $email): Speaker | null;
  public function save(Speaker $speaker): void;
}