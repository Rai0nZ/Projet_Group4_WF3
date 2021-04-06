<?php

namespace App\Entity;

use App\Repository\NiveauxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauxRepository::class)
 */
class Niveaux
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
    private $niveaux_classe;

    /**
     * @ORM\OneToMany(targetEntity=Fiches::class, mappedBy="niveau")
     */
    private $fiches;

    public function __construct()
    {
        $this->fiches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveauxClasse(): ?string
    {
        return $this->niveaux_classe;
    }

    public function setNiveauxClasse(string $niveaux_classe): self
    {
        $this->niveaux_classe = $niveaux_classe;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->getNiveauxClasse();
    }

    /**
     * @return Collection|Fiches[]
     */
    public function getFiches(): Collection
    {
        return $this->fiches;
    }

    public function addFich(Fiches $fich): self
    {
        if (!$this->fiches->contains($fich)) {
            $this->fiches[] = $fich;
            $fich->setNiveau($this);
        }

        return $this;
    }

    public function removeFich(Fiches $fich): self
    {
        if ($this->fiches->removeElement($fich)) {
            // set the owning side to null (unless already changed)
            if ($fich->getNiveau() === $this) {
                $fich->setNiveau(null);
            }
        }

        return $this;
    }
}
