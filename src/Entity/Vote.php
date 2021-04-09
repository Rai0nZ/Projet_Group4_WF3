<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 */
class Vote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Fiches::class, inversedBy="votes", cascade={"persist", "remove"})
     */
    private $fiche;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="vote", cascade={"persist", "remove"})
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getFiche(): ?Fiches
    {
        return $this->fiche;
    }

    public function setFiche(?Fiches $fiche): self
    {
        $this->fiche = $fiche;

        return $this;
    }
}
