<?php

namespace App\Entity;

use App\Repository\ContenirRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContenirRepository::class)
 */
class Contenir
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiteCommandee;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="contenirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCommande;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="contenirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idArticle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteCommandee(): ?int
    {
        return $this->quantiteCommandee;
    }

    public function setQuantiteCommandee(int $quantiteCommandee): self
    {
        $this->quantiteCommandee = $quantiteCommandee;

        return $this;
    }

    public function getIdCommande(): ?Commande
    {
        return $this->idCommande;
    }

    public function setIdCommande(?Commande $idCommande): self
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    public function getIdArticle(): ?article
    {
        return $this->idArticle;
    }

    public function setIdArticle(?article $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }
}
