<?php

namespace App\Entity;

use App\Repository\FichesRepository;
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
     * @ORM\Column(type="string", length=255)
     */
    private $Auteur;

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

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(string $Auteur): self
    {
        $this->Auteur = $Auteur;

        return $this;
    }
}
