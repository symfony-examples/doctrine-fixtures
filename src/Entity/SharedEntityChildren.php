<?php

namespace App\Entity;

use App\Repository\SharedEntityChildrenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SharedEntityChildrenRepository::class)]
class SharedEntityChildren
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'sharedEntityChildrens')]
    private ?SharedEntityParent $owner = null;

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

    public function getOwner(): ?SharedEntityParent
    {
        return $this->owner;
    }

    public function setOwner(?SharedEntityParent $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
