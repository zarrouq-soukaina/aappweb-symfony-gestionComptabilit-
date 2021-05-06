<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
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
    private $dateFact;

    /**
     * @ORM\Column(type="string")
     */
    private $paiment;

    

    /**
     * @ORM\OneToOne(targetEntity=Commandevente::class, inversedBy="factures", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=Paiment::class, mappedBy="factures", cascade={"persist", "remove"})
     */
    private $paiments;

    /**
     * @ORM\OneToOne(targetEntity=Livraison::class, mappedBy="factures", cascade={"persist", "remove"})
     */
    private $livraisons;

  

    

    public function __construct()
    {
        $this->test = new ArrayCollection();
        $this->tes = new ArrayCollection();
    }
    public function __toString(){
      
        // pour afficher le id de la facture dans la sélection
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

    public function getDateFact(): ?\DateTimeInterface
    {
        return $this->dateFact;
    }

    public function setDateFact(\DateTimeInterface $dateFact): self
    {
        $this->dateFact = $dateFact;

        return $this;
    }

    public function getPaiment(): ?string
    {
        return $this->paiment;
    }

    public function setPaiment(string $paiment): self
    {
        $this->paiment = $paiment;

        return $this;
    }

  

    public function getCommandes(): ?Commandevente
    {
        return $this->commandes;
    }

    public function setCommandes(Commandevente $commandes): self
    {
        $this->commandes = $commandes;

        return $this;
    }

    public function getPaiments(): ?Paiment
    {
        return $this->paiments;
    }

    public function setPaiments(Paiment $paiments): self
    {
        $this->paiments = $paiments;

        // set the owning side of the relation if necessary
        if ($paiments->getFactures() !== $this) {
            $paiments->setFactures($this);
        }

        return $this;
    }

    public function getLivraisons(): ?Livraison
    {
        return $this->livraisons;
    }

    public function setLivraisons(Livraison $livraisons): self
    {
        $this->livraisons = $livraisons;

        // set the owning side of the relation if necessary
        if ($livraisons->getFactures() !== $this) {
            $livraisons->setFactures($this);
        }

        return $this;
    }

  
}
