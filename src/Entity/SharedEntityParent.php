<?php

namespace App\Entity;

use App\Repository\SharedEntityParentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SharedEntityParentRepository::class)]
class SharedEntityParent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: SharedEntityChildren::class)]
    private Collection $sharedEntityChildrens;

    public function __construct()
    {
        $this->sharedEntityChildrens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, SharedEntityChildren>
     */
    public function getSharedEntityChildrens(): Collection
    {
        return $this->sharedEntityChildrens;
    }

    public function addSharedEntityChildren(SharedEntityChildren $sharedEntityChildren): self
    {
        if (!$this->sharedEntityChildrens->contains($sharedEntityChildren)) {
            $this->sharedEntityChildrens->add($sharedEntityChildren);
            $sharedEntityChildren->setOwner($this);
        }

        return $this;
    }

    public function removeSharedEntityChildren(SharedEntityChildren $sharedEntityChildren): self
    {
        if ($this->sharedEntityChildrens->removeElement($sharedEntityChildren)) {
            // set the owning side to null (unless already changed)
            if ($sharedEntityChildren->getOwner() === $this) {
                $sharedEntityChildren->setOwner(null);
            }
        }

        return $this;
    }
}
