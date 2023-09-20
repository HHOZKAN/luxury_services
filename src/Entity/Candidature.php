<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
class Candidature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'candidature', targetEntity: candidat::class)]
    private Collection $candidat;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?emploi $emploi = null;

    public function __construct()
    {
        $this->candidat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, candidat>
     */
    public function getCandidat(): Collection
    {
        return $this->candidat;
    }

    public function addCandidat(candidat $candidat): static
    {
        if (!$this->candidat->contains($candidat)) {
            $this->candidat->add($candidat);
            $candidat->setCandidature($this);
        }

        return $this;
    }

    public function removeCandidat(candidat $candidat): static
    {
        if ($this->candidat->removeElement($candidat)) {
            // set the owning side to null (unless already changed)
            if ($candidat->getCandidature() === $this) {
                $candidat->setCandidature(null);
            }
        }

        return $this;
    }

    public function getEmploi(): ?emploi
    {
        return $this->emploi;
    }

    public function setEmploi(?emploi $emploi): static
    {
        $this->emploi = $emploi;

        return $this;
    }
}
