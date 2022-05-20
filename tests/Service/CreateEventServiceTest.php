<?php

namespace App\Tests\Repository;

use PHPUnit\Framework\TestCase;
use App\Service\Event\CreateEventService;
use App\Tests\Repository\FakeEventRepository;
use App\Dtos\CreateEventDTO;
use App\Entity\Event;

class CreateEventServiceTest extends TestCase
{
  private $service;
  private $repository;

  protected function setUp(): void
  {
    $this->repository = new FakeEventRepository();
    $this->service = new CreateEventService($this->repository);
  }

  public function testMustBeAbleToCreateEvent()
  {
    
    $event = new CreateEventDTO([
      'title' => 'title',
      'start_date' => '2022-03-03',
      'end_date' => '2022-03-04',
      'description' => 'description',
      'status' => 'agendado'
    ]);

    $response = $this->service->execute($event);

    $this->assertIsInt($response->getId());
    $this->assertSame('title', $response->getTitle());
    $this->assertSame('description', $response->getDescription());
    $this->assertSame('agendado', $response->getStatus());
  }
}
