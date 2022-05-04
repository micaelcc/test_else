<?php

namespace App\Tests\Repository;

use PHPUnit\Framework\TestCase;
use App\Service\Speaker\CreateSpeakerService;
use App\Tests\Repository\FakeSpeakerService;
use App\Dtos\CreateSpeakerDTO;
use App\Entity\Speaker;

class CreateSpeakerServiceTest extends TestCase
{
  private $service;
  private $repository;

  public function makeSut() {
    $this->repository = new FakeSpeakerRepository();
    $this->service = new CreateSpeakerService($this->repository);
  }
  /**
   * @test
   */
  public function mustBeAbleToCreateSpeaker()
  {
    $this->makeSut();
    
    $speaker = new CreateSpeakerDTO([
      'email' => 'valid_mail@mail.com',
      'name' => 'valid_name'
    ]);

    $response = $this->service->execute($speaker);

    $this->assertIsInt($response->getId());
    $this->assertSame('valid_mail@mail.com', $response->getEmail());
    $this->assertSame('valid_name', $response->getName());
  }
}