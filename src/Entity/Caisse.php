<?php

namespace App\Entity;

use App\Repository\CaisseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaisseRepository::class)
 */
class Caisse
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
     * @ORM\Column(type="date")
     */
    private $dateModif;

    /**
     * @ORM\Column(type="text")
     */
    private $Motif;

    /**
     * @ORM\OneToOne(targetEntity=Cheque::class, cascade={"persist", "remove"})
     */
    private $sortiecheques;

    /**
     * @ORM\ManyToOne(targetEntity=Paiment::class, cascade={"persist", "remove"})
     */
    private $paiementvente;


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

    public function getDateModif(): ?\DateTimeInterface
    {
        return $this->dateModif;
    }

    public function setDateModif(\DateTimeInterface $dateModif): self
    {
        $this->dateModif = $dateModif;

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

    public function getSortiecheques(): ?Cheque
    {
        return $this->sortiecheques;
    }

    public function setSortiecheques(?Cheque $sortiecheques): self
    {
        $this->sortiecheques = $sortiecheques;

        return $this;
    }

    public function getPaiementvente(): ?Paiment
    {
        return $this->paiementvente;
    }

    public function setPaiementvente(?Paiment $paiementvente): self
    {
        $this->paiementvente = $paiementvente;

        return $this;
    }
}
