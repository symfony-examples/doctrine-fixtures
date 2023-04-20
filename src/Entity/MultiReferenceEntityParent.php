<?php

namespace App\Entity;

use App\Repository\MultiReferenceEntityParentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultiReferenceEntityParentRepository::class)]
class MultiReferenceEntityParent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\ManyToMany(targetEntity: MultiReferenceEntityChildren::class, mappedBy: 'owners')]
    private Collection $multiReferenceEntityChildrens;

    public function __construct()
    {
        $this->multiReferenceEntityChildrens = new ArrayCollection();
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
     * @return Collection<int, MultiReferenceEntityChildren>
     */
    public function getMultiReferenceEntityChildrens(): Collection
    {
        return $this->multiReferenceEntityChildrens;
    }

    public function addMultiReferenceEntityChildren(MultiReferenceEntityChildren $multiReferenceEntityChildren): self
    {
        if (!$this->multiReferenceEntityChildrens->contains($multiReferenceEntityChildren)) {
            $this->multiReferenceEntityChildrens->add($multiReferenceEntityChildren);
            $multiReferenceEntityChildren->addOwner($this);
        }

        return $this;
    }

    public function removeMultiReferenceEntityChildren(MultiReferenceEntityChildren $multiReferenceEntityChildren): self
    {
        if ($this->multiReferenceEntityChildrens->removeElement($multiReferenceEntityChildren)) {
            $multiReferenceEntityChildren->removeOwner($this);
        }

        return $this;
    }
}
