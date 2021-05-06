<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $Nom;

    /**
     * @ORM\Column(type="string")
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string")
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string")
     */
    private $Type;

    /**
     * @ORM\OneToMany(targetEntity=Commandevente::class, mappedBy="Clients", orphanRemoval=true)
     */
    private $ventes;
    public function __toString(){
        // pour afficher le nom de l'auteur dans la sélection
        return $this->Nom;
        return $this->Prenom;
       

        // pour afficher le id de l'auteur dans la sélection
         return $this->id;
    }

    public function __construct()
    {
        $this->ventes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return Collection|Commandevente[]
     */
    public function getVentes(): Collection
    {
        return $this->ventes;
    }

    public function addVente(Commandevente $vente): self
    {
        if (!$this->ventes->contains($vente)) {
            $this->ventes[] = $vente;
            $vente->setClients($this);
        }

        return $this;
    }

    public function removeVente(Commandevente $vente): self
    {
        if ($this->ventes->contains($vente)) {
            $this->ventes->removeElement($vente);
            // set the owning side to null (unless already changed)
            if ($vente->getClients() === $this) {
                $vente->setClients(null);
            }
        }

        return $this;
    }
}
