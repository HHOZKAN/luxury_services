<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\OneToOne(mappedBy: 'passport', cascade: ['persist', 'remove'])]
    private ?Candidat $PassportCandidat = null;

    #[ORM\OneToOne(mappedBy: 'cv', cascade: ['persist', 'remove'])]
    private ?Candidat $CvCandidat = null;

    #[ORM\OneToOne(mappedBy: 'profil_picture', cascade: ['persist', 'remove'])]
    private ?Candidat $ProfilPictureCandidat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getPassportCandidat(): ?Candidat
    {
        return $this->PassportCandidat;
    }

    public function setPassportCandidat(Candidat $PassportCandidat): static
    {
        // set the owning side of the relation if necessary
        if ($PassportCandidat->getPassport() !== $this) {
            $PassportCandidat->setPassport($this);
        }

        $this->PassportCandidat = $PassportCandidat;

        return $this;
    }

    public function getCvCandidat(): ?Candidat
    {
        return $this->CvCandidat;
    }

    public function setCvCandidat(Candidat $CvCandidat): static
    {
        // set the owning side of the relation if necessary
        if ($CvCandidat->getCv() !== $this) {
            $CvCandidat->setCv($this);
        }

        $this->CvCandidat = $CvCandidat;

        return $this;
    }

    public function getProfilPictureCandidat(): ?Candidat
    {
        return $this->ProfilPictureCandidat;
    }

    public function setProfilPictureCandidat(Candidat $ProfilPictureCandidat): static
    {
        // set the owning side of the relation if necessary
        if ($ProfilPictureCandidat->getProfilPicture() !== $this) {
            $ProfilPictureCandidat->setProfilPicture($this);
        }

        $this->ProfilPictureCandidat = $ProfilPictureCandidat;

        return $this;
    }
}
