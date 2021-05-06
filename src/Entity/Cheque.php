<?php

namespace App\Entity;

use App\Repository\ChequeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChequeRepository::class)
 */
class Cheque
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $beneficiare;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Depense::class, inversedBy="cheques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $depenses;
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

    public function getBeneficiare(): ?string
    {
        return $this->beneficiare;
    }

    public function setBeneficiare(string $beneficiare): self
    {
        $this->beneficiare = $beneficiare;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDepenses(): ?Depense
    {
        return $this->depenses;
    }

    public function setDepenses(?Depense $depenses): self
    {
        $this->depenses = $depenses;

        return $this;
    }
}
