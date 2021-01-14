<?php

namespace App\Entity;

use App\Repository\CreneauRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreneauRepository::class)
 */
class Creneau
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
    private $dateCreneau;

    /**
     * @ORM\Column(type="integer")
     */
    private $etatCreneau;

    /**
     * @ORM\ManyToOne(targetEntity=Magasin::class, inversedBy="creneaus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idMagasin;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="creneaus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreneau(): ?\DateTimeInterface
    {
        return $this->dateCreneau;
    }

    public function setDateCreneau(\DateTimeInterface $dateCreneau): self
    {
        $this->dateCreneau = $dateCreneau;

        return $this;
    }

    public function getEtatCreneau(): ?int
    {
        return $this->etatCreneau;
    }

    public function setEtatCreneau(int $etatCreneau): self
    {
        $this->etatCreneau = $etatCreneau;

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
