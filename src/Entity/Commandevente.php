<?php

namespace App\Entity;

use App\Repository\CommandeventeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeventeRepository::class)
 */
class Commandevente
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
    private $DateVente;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="ventes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Clients;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, inversedBy="ventes")
     */
    private $Produits;



    /**
     * @ORM\OneToOne(targetEntity=Facture::class, mappedBy="commandes", cascade={"persist", "remove"})
     */
    private $factures;

    /**
     * @ORM\OneToMany(targetEntity=CommandeventeProduit::class, mappedBy="commandevente", orphanRemoval=true,cascade={"persist", "remove"})
     */
    private $commandeventeProduits;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total;

   
    public function __toString(){
       
        // pour afficher le id de l'auteur dans la sélection
         return $this->id;
    }

    public function __construct()
    {
        $this->Produits = new ArrayCollection();
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

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->DateVente;
    }

    public function setDateVente(\DateTimeInterface $DateVente): self
    {
        $this->DateVente = $DateVente;

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->Clients;
    }

    public function setClients(?Client $Clients): self
    {
        $this->Clients = $Clients;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->Produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->Produits->contains($produit)) {
            $this->Produits[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->Produits->contains($produit)) {
            $this->Produits->removeElement($produit);
        }

        return $this;
    }

    
    public function getFactures(): ?Facture
    {
        return $this->factures;
    }

    public function setFactures(Facture $factures): self
    {
        $this->factures = $factures;

        // set the owning side of the relation if necessary
        if ($factures->getCommandes() !== $this) {
            $factures->setCommandes($this);
        }

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
            $commandeventeProduit->setCommandevente($this);
        }

        return $this;
    }

    public function removeCommandeventeProduit(CommandeventeProduit $commandeventeProduit): self
    {
        if ($this->commandeventeProduits->contains($commandeventeProduit)) {
            $this->commandeventeProduits->removeElement($commandeventeProduit);
            // set the owning side to null (unless already changed)
            if ($commandeventeProduit->getCommandevente() === $this) {
                $commandeventeProduit->setCommandevente(null);
            }
        }

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

        return $this;
    }

 
}
