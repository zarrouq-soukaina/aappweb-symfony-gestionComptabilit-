<?php

namespace App\Entity;

use App\Repository\CommandeachatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeachatRepository::class)
 */
class Commandeachat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAchat;

    /**
     * @ORM\Column(type="integer")
     */
    private $refFacture;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="achats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fournisseurs;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    /**
     * @ORM\OneToOne(targetEntity=Depense::class, mappedBy="achats", cascade={"persist", "remove"})
     */
    private $depenses;

    /**
     * @ORM\Column(type="integer")
     */
    private $tva;
    public function __toString(){
        
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

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getRefFacture(): ?int
    {
        return $this->refFacture;
    }

    public function setRefFacture(int $refFacture): self
    {
        $this->refFacture = $refFacture;

        return $this;
    }

    public function getFournisseurs(): ?Fournisseur
    {
        return $this->fournisseurs;
    }

    public function setFournisseurs(?Fournisseur $fournisseurs): self
    {
        $this->fournisseurs = $fournisseurs;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getDepenses(): ?Depense
    {
        return $this->depenses;
    }

    public function setDepenses(?Depense $depenses): self
    {
        $this->depenses = $depenses;

        // set (or unset) the owning side of the relation if necessary
        $newAchats = null === $depenses ? null : $this;
        if ($depenses->getAchats() !== $newAchats) {
            $depenses->setAchats($newAchats);
        }

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }
}
