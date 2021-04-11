<?php

namespace App\Entity;

use App\Repository\FichesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FichesRepository::class)
 */
class Fiches
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Chapitre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $concept_cle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Formules;

    /**
     * @ORM\Column(type="text")
     */
    private $A_retenir;

    /**
     * @ORM\ManyToOne(targetEntity=Niveaux::class, inversedBy="fiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity=Disciplines::class, inversedBy="fiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Discipline;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="fiches_prof")
     * @ORM\JoinColumn(nullable=true)
     */
    private $auteur;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="fiche", orphanRemoval=true)
     */
    private $votes;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="fiches_enregistrees")
     */
    private $utilisateurs_enregistrees;

    public function __construct()
    {
        $this->utilisateurs_enregistrees = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChapitre(): ?string
    {
        return $this->Chapitre;
    }

    public function setChapitre(string $Chapitre): self
    {
        $this->Chapitre = $Chapitre;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getConceptCle(): ?string
    {
        return $this->concept_cle;
    }

    public function setConceptCle(string $concept_cle): self
    {
        $this->concept_cle = $concept_cle;

        return $this;
    }

    public function getFormules(): ?string
    {
        return $this->Formules;
    }

    public function setFormules(?string $Formules): self
    {
        $this->Formules = $Formules;

        return $this;
    }

    public function getARetenir(): ?string
    {
        return $this->A_retenir;
    }

    public function setARetenir(string $A_retenir): self
    {
        $this->A_retenir = $A_retenir;

        return $this;
    }

    public function getNiveau(): ?Niveaux
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveaux $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDiscipline(): ?Disciplines
    {
        return $this->Discipline;
    }

    public function setDiscipline(?Disciplines $Discipline): self
    {
        $this->Discipline = $Discipline;

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

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur = null): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setFiche($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getFiche() === $this) {
                $vote->setFiche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUtilisateursEnregistrees(): Collection
    {
        return $this->utilisateurs_enregistrees;
    }

    public function addUtilisateursEnregistree(User $utilisateursEnregistree): self
    {
        if (!$this->utilisateurs_enregistrees->contains($utilisateursEnregistree)) {
            $this->utilisateurs_enregistrees[] = $utilisateursEnregistree;
            $utilisateursEnregistree->addFichesEnregistree($this);
        }

        return $this;
    }

    public function removeUtilisateursEnregistree(User $utilisateursEnregistree): self
    {
        if ($this->utilisateurs_enregistrees->removeElement($utilisateursEnregistree)) {
            $utilisateursEnregistree->removeFichesEnregistree($this);
        }

        return $this;
    }
}
