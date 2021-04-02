<?php

namespace App\Entity;

use App\Repository\DisciplinesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DisciplinesRepository::class)
 */
class Disciplines
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
    private $Matieres;

    /**
     * @ORM\OneToMany(targetEntity=Fiches::class, mappedBy="Discipline", orphanRemoval=true)
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

    public function getMatieres(): ?string
    {
        return $this->Matieres;
    }

    public function setMatieres(string $Matieres): self
    {
        $this->Matieres = $Matieres;

        return $this;
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
            $fich->setDiscipline($this);
        }

        return $this;
    }

    public function removeFich(Fiches $fich): self
    {
        if ($this->fiches->removeElement($fich)) {
            // set the owning side to null (unless already changed)
            if ($fich->getDiscipline() === $this) {
                $fich->setDiscipline(null);
            }
        }

        return $this;
    }
}
