<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseurRepository::class)
 */
class Fournisseur
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string")
     */
    private $Type;

    /**
     * @ORM\Column(type="string")
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Commandeachat::class, mappedBy="fournisseurs", orphanRemoval=true)
     */
    private $achats;

    public function __construct()
    {
        $this->achats = new ArrayCollection();
    }
    public function __toString(){
        return $this->Nom;
        // pour afficher le id de l'auteur dans la sélection
         return $this->id;
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

    public function setPrenom(?string $Prenom): self
    {
        $this->Prenom = $Prenom;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Commandeachat[]
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Commandeachat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->setFournisseurs($this);
        }

        return $this;
    }

    public function removeAchat(Commandeachat $achat): self
    {
        if ($this->achats->contains($achat)) {
            $this->achats->removeElement($achat);
            // set the owning side to null (unless already changed)
            if ($achat->getFournisseurs() === $this) {
                $achat->setFournisseurs(null);
            }
        }

        return $this;
    }
}
