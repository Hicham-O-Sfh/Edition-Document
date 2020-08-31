<?php

namespace App\Entity;

use App\Repository\MouvementPersonnelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MouvementPersonnelRepository::class)
 */
class MouvementPersonnel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAffectation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $decision;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class, inversedBy="mouvementPersonnels")
     */
    private $personnel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numDecision;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDecision;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fichier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeaffectation;

    /**
     * @ORM\ManyToOne(targetEntity=ListAffectation::class, inversedBy="mouvementPersonnels")
     */
    private $lieuAffectation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $duree;



    public function getId(): ?int
    {
        return $this->id;
    }



    public function getDateAffectation(): ?\DateTimeInterface
    {
        return $this->dateAffectation;
    }

    public function setDateAffectation(?\DateTimeInterface $dateAffectation): self
    {
        $this->dateAffectation = $dateAffectation;

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

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }


    public function getDecision(): ?string
    {
        return $this->decision;
    }

    public function setDecision(?string $decision): self
    {
        $this->decision = $decision;

        return $this;
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

    public function getNumDecision(): ?string
    {
        return $this->numDecision;
    }

    public function setNumDecision(?string $numDecision): self
    {
        $this->numDecision = $numDecision;

        return $this;
    }

    public function getDateDecision(): ?\DateTimeInterface
    {
        return $this->dateDecision;
    }

    public function setDateDecision(?\DateTimeInterface $dateDecision): self
    {
        $this->dateDecision = $dateDecision;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(?string $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getLieuAffectation(): ?string
    {
        return $this->lieuAffectation;
    }

    public function setLieuAffectation(?ListAffectation $lieuAffectation): self
    {
        $this->lieuAffectation = $lieuAffectation;

        return $this;
    }




    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getTypeaffectation(): ?string
    {
        return $this->typeaffectation;
    }

    public function setTypeaffectation(?string $typeaffectation): self
    {
        $this->typeaffectation = $typeaffectation;

        return $this;
    }


}
