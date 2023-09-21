<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatRepository::class)]
class Candidat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $genre = null;

    #[ORM\Column(length: 25)]
    private ?string $nom = null;

    #[ORM\Column(length: 25)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 100)]
    private ?string $pays = null;

    #[ORM\Column(length: 100)]
    private ?string $nationalite = null;

    #[ORM\Column]
    private ?bool $ispassport = null;

    #[ORM\Column]
    private ?int $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_naissance = null;


    #[ORM\Column]
    private ?bool $disponibilite = null;

    #[ORM\Column(length: 100)]
    private ?string $job_categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $experience = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_create = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_uptaded = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_deleted = null;

 





    #[ORM\OneToOne(inversedBy: 'candidat', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToOne(inversedBy: 'PassportCandidat', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Media $passport = null;

    #[ORM\OneToOne(inversedBy: 'CvCandidat', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Media $cv = null;

    #[ORM\OneToOne(inversedBy: 'ProfilPictureCandidat', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Media $profil_picture = null;

    #[ORM\OneToMany(mappedBy: 'candidat', targetEntity: Candidature::class, orphanRemoval: true)]
    private Collection $Candidature;

    public function __construct()
    {
        $this->Candidature = new ArrayCollection();
    }



  


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function isIspassport(): ?bool
    {
        return $this->ispassport;
    }

    public function setIspassport(bool $ispassport): static
    {
        $this->ispassport = $ispassport;

        return $this;
    }

    public function getDateNaissance(): ?int
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(int $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance(string $lieu_naissance): static
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }



    public function isDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getJobCategorie(): ?string
    {
        return $this->job_categorie;
    }

    public function setJobCategorie(string $job_categorie): static
    {
        $this->job_categorie = $job_categorie;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

    public function setDateCreate(\DateTimeInterface $date_create): static
    {
        $this->date_create = $date_create;

        return $this;
    }

    public function getDateUptaded(): ?\DateTimeInterface
    {
        return $this->date_uptaded;
    }

    public function setDateUptaded(\DateTimeInterface $date_uptaded): static
    {
        $this->date_uptaded = $date_uptaded;

        return $this;
    }

    public function getDateDeleted(): ?\DateTimeInterface
    {
        return $this->date_deleted;
    }

    public function setDateDeleted(\DateTimeInterface $date_deleted): static
    {
        $this->date_deleted = $date_deleted;

        return $this;
    }



    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(user $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPassport(): ?Media
    {
        return $this->passport;
    }

    public function setPassport(Media $passport): static
    {
        $this->passport = $passport;

        return $this;
    }

    public function getCv(): ?Media
    {
        return $this->cv;
    }

    public function setCv(media $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getProfilPicture(): ?Media
    {
        return $this->profil_picture;
    }

    public function setProfilPicture(Media $profil_picture): static
    {
        $this->profil_picture = $profil_picture;

        return $this;
    }

    /**
     * @return Collection<int, Candidature>
     */
    public function getCandidature(): Collection
    {
        return $this->Candidature;
    }

    public function addCandidature(Candidature $candidature): static
    {
        if (!$this->Candidature->contains($candidature)) {
            $this->Candidature->add($candidature);
            $candidature->setCandidat($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): static
    {
        if ($this->Candidature->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getCandidat() === $this) {
                $candidature->setCandidat(null);
            }
        }

        return $this;
    }


   
}
