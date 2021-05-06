<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="text")
     */
    private $id; 

    /**
     * @ORM\Column(type="text")
     */
    private $Designation;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrixAHT;

   

    /**
     * @ORM\Column(type="integer")
     */
    private $tva;

    /**
     * @ORM\ManyToMany(targetEntity=Commandevente::class, mappedBy="Produits")
     */
    private $ventes;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteStock;

    /**
     * @ORM\OneToMany(targetEntity=CommandeventeProduit::class, mappedBy="produit", orphanRemoval=true)
     */
    private $commandeventeProduits;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixTTC;
    public function __toString(){
       
        return $this->Designation;
        
    }

    
    public function __construct()
    {
        $this->ventes = new ArrayCollection();
        $this->commandeventeProduits = new ArrayCollection();
       
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

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(string $Designation): self
    {
        $this->Designation = $Designation;

        return $this;
    }

    public function getPrixAHT(): ?int
    {
        return $this->PrixAHT;
    }

    public function setPrixAHT(int $PrixAHT): self
    {
        $this->PrixAHT = $PrixAHT;

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
            $vente->addProduit($this);
        }

        return $this;
    }

    public function removeVente(Commandevente $vente): self
    {
        if ($this->ventes->contains($vente)) {
            $this->ventes->removeElement($vente);
            $vente->removeProduit($this);
        }

        return $this;
    }

    public function getQteStock(): ?int
    {
        return $this->qteStock;
    }

    public function setQteStock(int $qteStock): self
    {
        $this->qteStock = $qteStock;

        return $this;
    }

    /**
     * @return Collection|CommandeventeProduit[]
     */
    public function getCommandeventeProduits(): Collection
    {
        return $this->commandeventeProduits;
    }

    public function addCommandeventeProduit(CommandeventeProduit $commandeventeProduit): self
    {
        if (!$this->commandeventeProduits->contains($commandeventeProduit)) {
            $this->commandeventeProduits[] = $commandeventeProduit;
            $commandeventeProduit->setProduit($this);
        }

        return $this;
    }

    public function removeCommandeventeProduit(CommandeventeProduit $commandeventeProduit): self
    {
        if ($this->commandeventeProduits->contains($commandeventeProduit)) {
            $this->commandeventeProduits->removeElement($commandeventeProduit);
            // set the owning side to null (unless already changed)
            if ($commandeventeProduit->getProduit() === $this) {
                $commandeventeProduit->setProduit(null);
            }
        }

        return $this;
    }

    public function getPrixTTC(): ?int
    {
        return $this->prixTTC;
    }

    public function setPrixTTC(?int $prixTTC): self
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }

   
}
