<?php

namespace App\Entity;

use App\Repository\PaimentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaimentRepository::class)
 */
class Paiment
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
    private $datepai;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="paiments", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $factures;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mantantRest;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $montantpay;

    
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

    public function getDatepai(): ?\DateTimeInterface
    {
        return $this->datepai;
    }

    public function setDatepai(\DateTimeInterface $datepai): self
    {
        $this->datepai = $datepai;

        return $this;
    }

    public function getFactures(): ?Facture
    {
        return $this->factures;
    }

    public function setFactures(Facture $factures): self
    {
        $this->factures = $factures;

        return $this;
    }

    public function getMantantRest(): ?int
    {
        return $this->mantantRest;
    }

    public function setMantantRest(?int $mantantRest): self
    {
        $this->mantantRest = $mantantRest;

        return $this;
    }

    public function getMontantpay(): ?int
    {
        return $this->montantpay;
    }

    public function setMontantpay(?int $montantpay): self
    {
        $this->montantpay = $montantpay;

        return $this;
    }

   
}
