<?php

namespace App\Entity;

use App\Repository\DepenseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepenseRepository::class)
 */
class Depense
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Montant;

    /**
     * @ORM\Column(type="text")
     */
    private $Motif;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDepense;

    /**
     * @ORM\Column(type="string")
     */
    private $modePai;

    /**
     * @ORM\OneToMany(targetEntity=Cheque::class, mappedBy="depenses", orphanRemoval=true)
     */
    private $cheques;

    /**
     * @ORM\OneToOne(targetEntity=Commandeachat::class, inversedBy="depenses", cascade={"persist", "remove"})
     */
    private $achats;

    
   

    public function __construct()
    {
        $this->cheques = new ArrayCollection();
    }

    public function __toString(){
      
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

    public function getMontant(): ?int
    {
        return $this->Montant;
    }

    public function setMontant(int $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->Motif;
    }

    public function setMotif(string $Motif): self
    {
        $this->Motif = $Motif;

        return $this;
    }

    public function getDateDepense(): ?\DateTimeInterface
    {
        return $this->DateDepense;
    }

    public function setDateDepense(\DateTimeInterface $DateDepense): self
    {
        $this->DateDepense = $DateDepense;

        return $this;
    }

    public function getModePai(): ?string
    {
        return $this->modePai;
    }

    public function setModePai(string $modePai): self
    {
        $this->modePai = $modePai;

        return $this;
    }

    /**
     * @return Collection|Cheque[]
     */
    public function getCheques(): Collection
    {
        return $this->cheques;
    }

    public function addCheque(Cheque $cheque): self
    {
        if (!$this->cheques->contains($cheque)) {
            $this->cheques[] = $cheque;
            $cheque->setDepenses($this);
        }

        return $this;
    }

    public function removeCheque(Cheque $cheque): self
    {
        if ($this->cheques->contains($cheque)) {
            $this->cheques->removeElement($cheque);
            // set the owning side to null (unless already changed)
            if ($cheque->getDepenses() === $this) {
                $cheque->setDepenses(null);
            }
        }

        return $this;
    }

    public function getAchats(): ?Commandeachat
    {
        return $this->achats;
    }

    public function setAchats(?Commandeachat $achats): self
    {
        $this->achats = $achats;

        return $this;
    }


   
}
