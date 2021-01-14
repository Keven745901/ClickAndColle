<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCommande;

    /**
     * @ORM\Column(type="integer")
     */
    private $etatCommande;

    /**
     * @ORM\OneToMany(targetEntity=Contenir::class, mappedBy="idCommande")
     */
    private $contenirs;

    /**
     * @ORM\ManyToOne(targetEntity=Magasin::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idMagasin;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    public function __construct()
    {
        $this->contenirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getEtatCommande(): ?int
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(int $etatCommande): self
    {
        $this->etatCommande = $etatCommande;

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
            $contenir->setIdCommande($this);
        }

        return $this;
    }

    public function removeContenir(Contenir $contenir): self
    {
        if ($this->contenirs->removeElement($contenir)) {
            // set the owning side to null (unless already changed)
            if ($contenir->getIdCommande() === $this) {
                $contenir->setIdCommande(null);
            }
        }

        return $this;
    }

    public function getIdMagasin(): ?magasin
    {
        return $this->idMagasin;
    }

    public function setIdMagasin(?magasin $idMagasin): self
    {
        $this->idMagasin = $idMagasin;

        return $this;
    }

    public function getIdUser(): ?user
    {
        return $this->idUser;
    }

    public function setIdUser(?user $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
