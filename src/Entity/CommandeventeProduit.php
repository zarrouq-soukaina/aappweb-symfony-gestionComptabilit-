<?php

namespace App\Entity;

use App\Repository\CommandeventeProduitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeventeProduitRepository::class)
 */
class CommandeventeProduit
{
   

    /**
     *  @ORM\Id()
     * @ORM\ManyToOne(targetEntity=Commandevente::class, inversedBy="CommandeventeProduits",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commandevente;

    /**
    * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="commandeventeProduits",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\Column(type="integer")
     */
    private $QteCom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Prix;

    

    public function getQteCom(): ?int
    {
        return $this->QteCom;
    }

    public function setQteCom(int $QteCom): self
    {
        $this->QteCom = $QteCom;

        return $this;
    }

    public function getCommandevente(): ?Commandevente
    {
        return $this->commandevente;
    }

    public function setCommandevente(?Commandevente $commandevente): self
    {
        $this->commandevente = $commandevente;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(?int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }
}
