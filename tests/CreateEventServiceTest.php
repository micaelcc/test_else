<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\Event\CreateEventService;
use App\Tests\FakeEventRepository;
use App\Dtos\CreateEventDTO;
use App\Entity\Event;

class CreateEventServiceTest extends TestCase
{
  private $service;
  private $repository;

  public function makeSut() {
    $this->repository = new FakeEventRepository();
    $this->service = new CreateEventService($this->repository);
  }
  /**
   * @test
   */
  public function mustBeAbleToCreateEvent()
  {
    $this->makeSut();
    
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