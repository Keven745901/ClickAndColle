<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=TypeArticle::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTypeArticle;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="idArticle")
     */
    private $stocks;

    /**
     * @ORM\OneToMany(targetEntity=Contenir::class, mappedBy="idArticle")
     */
    private $contenirs;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->contenirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdTypeArticle(): ?TypeArticle
    {
        return $this->idTypeArticle;
    }

    public function setIdTypeArticle(?TypeArticle $idTypeArticle): self
    {
        $this->idTypeArticle = $idTypeArticle;

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setIdArticle($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getIdArticle() === $this) {
                $stock->setIdArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contenir[]
     */
    public function getContenirs(): Collection
    {
        return $this->contenirs;
    }

    public function addContenir(Contenir $contenir): self
    {
        if (!$this->contenirs->contains($contenir)) {
            $this->contenirs[] = $contenir;
            $contenir->setIdArticle($this);
        }

        return $this;
    }

    public function removeContenir(Contenir $contenir): self
    {
        if ($this->contenirs->removeElement($contenir)) {
            // set the owning side to null (unless already changed)
            if ($contenir->getIdArticle() === $this) {
                $contenir->setIdArticle(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        
        return (string)$this->idTypeArticle;
    }

    
}
