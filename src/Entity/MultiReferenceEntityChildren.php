<?php

namespace App\Entity;

use App\Repository\MultiReferenceEntityChildrenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultiReferenceEntityChildrenRepository::class)]
class MultiReferenceEntityChildren
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: MultiReferenceEntityParent::class, inversedBy: 'multiReferenceEntityChildrens')]
    private Collection $owners;

    public function __construct()
    {
        $this->owners = new ArrayCollection();
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

    /**
     * @return Collection<int, MultiReferenceEntityParent>
     */
    public function getOwners(): Collection
    {
        return $this->owners;
    }

    public function addOwner(MultiReferenceEntityParent $owner): self
    {
        if (!$this->owners->contains($owner)) {
            $this->owners->add($owner);
        }

        return $this;
    }

    public function removeOwner(MultiReferenceEntityParent $owner): self
    {
        $this->owners->removeElement($owner);

        return $this;
    }
}
