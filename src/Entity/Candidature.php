<?php

namespace App\Entity;

use App\Entity\Candidat;
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

 

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?Emploi $emploi = null;

    #[ORM\ManyToOne(inversedBy: 'Candidature')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidat $candidat = null;


  

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCandidat(): ?Candidat
    {
        return $this->candidat;
    }

    public function setCandidat(?Candidat $candidat): static
    {
        $this->candidat = $candidat;

        return $this;
    }

    
}
