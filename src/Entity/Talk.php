<?php

namespace App\Entity;

use App\Repository\TalkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TalkRepository::class)]
#[ORM\Table(name: '`talks`')]
class Talk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $updated_at;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'talks')]
    #[ORM\JoinColumn(nullable: false)]
    private $event;

    #[ORM\Column(type: 'string')]
    private $start_time;

    #[ORM\Column(type: 'string')]
    private $end_time;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\ManyToOne(targetEntity: Speaker::class, inversedBy: 'talks')]
    #[ORM\JoinColumn(nullable: false, onDelete:"CASCADE")]
    private $speaker;

    public function __construct()
    {
        $this->updatedTimestamps();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event_id;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getStartTime(): ?string
    {
        return $this->start_time;
    }

    public function setStartTime(string $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?string
    {
        return $this->end_time;
    }

    public function setEndTime(string $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function updatedTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getSpeaker(): ?Speaker
    {
        return $this->speaker;
    }

    public function setSpeaker(?Speaker $speaker): self
    {
        $this->speaker = $speaker;

        return $this;
    }

    public function toJson()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'start_time' => $this->getStartTime(),
            'end_time' =>  $this->getEndTime(),
            'date' => $this->getDate()->format('d-m-Y'),
            'speaker' => [
                'name' => $this->speaker->getName(),
                'email' => $this->speaker->getEmail()
            ],
            'event' => [
                'title' => $this->event->getTitle(),
                'description' => $this->event->getDescription()
            ]
        ];
    }
}
