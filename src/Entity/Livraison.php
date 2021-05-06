<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivraisonRepository::class)
 */
class Livraison
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
    private $dateLiv;

    /**
     * @ORM\OneToOne(targetEntity=Facture::class, inversedBy="livraisons", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $factures;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDateLiv(): ?\DateTimeInterface
    {
        return $this->dateLiv;
    }

    public function setDateLiv(\DateTimeInterface $dateLiv): self
    {
        $this->dateLiv = $dateLiv;

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
}
