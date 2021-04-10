<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_naissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="integer")
     */
    private $numen;

    /**
     * @ORM\ManyToMany(targetEntity=Fiches::class, inversedBy="follow_id")
     */
    private $follow;

    /**
     * @ORM\OneToMany(targetEntity=Fiches::class, mappedBy="auteur", orphanRemoval=true)
     */
    private $fiches_prof;

    /**
     * @ORM\OneToOne(targetEntity=Vote::class, mappedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $votes;

    public function __construct()
    {
        $this->follow = new ArrayCollection();
        $this->fiches_prof = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getNumen(): ?int
    {
        return $this->numen;
    }

    public function setNumen(int $numen): self
    {
        $this->numen = $numen;

        return $this;
    }

    /**
     * @return Collection|Fiches[]
     */
    public function getFollow(): Collection
    {
        return $this->follow;
    }

    public function addFollow(Fiches $follow): self
    {
        if (!$this->follow->contains($follow)) {
            $this->follow[] = $follow;
        }

        return $this;
    }

    public function removeFollow(Fiches $follow): self
    {
        $this->follow->removeElement($follow);

        return $this;
    }

    /**
     * @return Collection|Fiches[]
     */
    public function getFichesProf(): Collection
    {
        return $this->fiches_prof;
    }

    public function addFichesProf(Fiches $fichesProf): self
    {
        if (!$this->fiches_prof->contains($fichesProf)) {
            $this->fiches_prof[] = $fichesProf;
            $fichesProf->setAuteur($this);
        }

        return $this;
    }

    public function removeFichesProf(Fiches $fichesProf): self
    {
        if ($this->fiches_prof->removeElement($fichesProf)) {
            // set the owning side to null (unless already changed)
            if ($fichesProf->getAuteur() === $this) {
                $fichesProf->setAuteur(null);
            }
        }

        return $this;
    }

    public function getVotes(): ?Vote
    {
        return $this->votes;
    }

    public function setVotes(?Vote $votes): self
    {
        // unset the owning side of the relation if necessary
        if ($votes === null && $this->votes !== null) {
            $this->votes->setUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($votes !== null && $votes->getUtilisateur() !== $this) {
            $votes->setUtilisateur($this);
        }

        $this->votes = $votes;

        return $this;
    }
}
