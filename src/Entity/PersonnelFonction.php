<?php

namespace App\Entity;

use App\Repository\PersonnelFonctionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnelFonctionRepository::class)
 */
class PersonnelFonction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class, inversedBy="personnelFonctions")
     */
    private $personnel;

    /**
     * @ORM\ManyToOne(targetEntity=Fonction::class, inversedBy="personnelFonctions")
     */
    private $fonction;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity=ListAffectation::class, inversedBy="personnelFonctions")
     */
    private $lieuAffectation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonnel(): ?Personnel
    {
        return $this->personnel;
    }

    public function setPersonnel(?Personnel $personnel): self
    {
        $this->personnel = $personnel;

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getLieuAffectation(): ?ListAffectation
    {
        return $this->lieuAffectation;
    }

    public function setLieuAffectation(?ListAffectation $affectation): self
    {
        $this->lieuAffectation = $affectation;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function __toString()
    {
      return $this->getId() ."";
    }
}
