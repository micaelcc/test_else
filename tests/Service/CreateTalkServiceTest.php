<?php

namespace App\Tests\Repository;

use PHPUnit\Framework\TestCase;
use App\Service\Talk\CreateTalkService;
use App\Tests\Repository\FakeTalkRepository;
use App\Dtos\CreateTalkDTO;
use App\Entity\Talk;
use App\Service\Event\CreateEventService;
use App\Tests\Repository\FakeEventRepository;
use App\Dtos\CreateEventDTO;
use App\Entity\Event;
use App\Service\Speaker\CreateSpeakerService;
use App\Tests\Repository\FakeSpeakerRepository;
use App\Dtos\CreateSpeakerDTO;
use App\Entity\Speaker;

class CreateTalkServiceTest extends TestCase
{
  private $createTalkService;
  private $fakeTalkRepository;

  private $createEventService;
  private $fakeEventRepository;

  private $createSpeakerService;
  private $fakeSpeakerService;

  public function makeSut() {
    $this->fakeEventRepository = new FakeEventRepository();
    $this->createEventService = new CreateEventService($this->fakeEventRepository);

    $this->fakeSpeakerRepository = new FakeSpeakerRepository();
    $this->createSpeakerService = new CreateSpeakerService($this->fakeSpeakerRepository);

    $this->fakeTalkRepository = new FakeTalkRepository();
    $this->createTalkService = new CreateTalkService(
      $this->fakeTalkRepository,
      $this->fakeEventRepository,
      $this->fakeSpeakerRepository,
    );
  }
  /**
   * @test
   */
  public function mustBeAbleToCreateTalk()
  {
    $this->makeSut();
    
    $event = new CreateEventDTO([
      'title' => 'event1',
      'start_date' => '2022-03-03',
      'end_date' => '2022-03-04',
      'description' => 'description',
      'status' => 'agendado'
    ]);
    
    $event_id = ($this->createEventService->execute($event))->getId();

    $speaker = new CreateSpeakerDTO([
      'email' => 'valid_mail@mail.com',
      'name' => 'valid_name'
    ]);

    $speaker_id = ($this->createSpeakerService->execute($speaker))->getId();

    $talk = new CreateTalkDTO([
      'title' => 'talk',
      'date' => '2022-03-04',
      'start_time' => '10:00',
      'end_time' => '10:30',
      'event_id' => $event_id,
      'description' => 'description',
      'speaker_id' => $speaker_id,
    ]);

    $response = $this->createTalkService->execute($talk);

    $this->assertIsInt($response->getId());
    $this->assertSame('talk', $response->getTitle());
    $this->assertSame('description', $response->getDescription());
  }
}