<?php

namespace App\Entity;

use App\Repository\TalkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TalkRepository::class)]
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
    private $event_id;

    #[ORM\Column(type: 'time')]
    private $start_time;

    #[ORM\Column(type: 'time')]
    private $end_time;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\ManyToMany(targetEntity: Speaker::class, inversedBy: 'talks')]
    private $speaker_id;

    public function __construct()
    {
        $this->speaker_id = new ArrayCollection();
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

    public function getEventId(): ?Event
    {
        return $this->event_id;
    }

    public function setEventId(?Event $event_id): self
    {
        $this->event_id = $event_id;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTimeInterface $end_time): self
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
     * @return Collection<int, Speaker>
     */
    public function getSpeakerId(): Collection
    {
        return $this->speaker_id;
    }

    public function addSpeakerId(Speaker $speakerId): self
    {
        if (!$this->speaker_id->contains($speakerId)) {
            $this->speaker_id[] = $speakerId;
        }

        return $this;
    }

    public function removeSpeakerId(Speaker $speakerId): self
    {
        $this->speaker_id->removeElement($speakerId);

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
}
