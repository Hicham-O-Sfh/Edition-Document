<?php

namespace App\Entity;

use App\Repository\PersonnelCongeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnelCongeRepository::class)
 */
class PersonnelConge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class, inversedBy="personnelConges")
     */
    private $personnel;

    /**
     * @ORM\ManyToOne(targetEntity=NatureConge::class, inversedBy="personnelConges")
     */
    private $natureConge;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDemandeConge;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebutConge;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFinConge;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $decisionDeChef = 'encours';

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDecisionChef;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observationDecisionChef;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motifRejet;




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

    public function getNatureConge(): ?NAtureConge
    {
        return $this->natureConge;
    }

    public function setNatureConge(?NAtureConge $natureConge): self
    {
        $this->natureConge = $natureConge;

        return $this;
    }

    public function getDateDemandeConge(): ?\DateTimeInterface
    {
        return $this->dateDemandeConge;
    }

    public function setDateDemandeConge(?\DateTimeInterface $dateDemandeConge): self
    {
        $this->dateDemandeConge = $dateDemandeConge;

        return $this;
    }


    public function getDateDebutConge(): ?\DateTimeInterface
    {
        return $this->dateDebutConge;
    }

    public function setDateDebutConge(?\DateTimeInterface $dateDebutConge): self
    {
        $this->dateDebutConge = $dateDebutConge;

        return $this;
    }

    public function getDateFinConge(): ?\DateTimeInterface
    {
        return $this->dateFinConge;
    }

    public function setDateFinConge(?\DateTimeInterface $dateFinConge): self
    {
        $this->dateFinConge = $dateFinConge;

        return $this;
    }

    public function getDecisionDeChef(): ?string
    {
        return $this->decisionDeChef;
    }

    public function setDecisionDeChef(?string $decisionDeChef): self
    {
        $this->decisionDeChef = $decisionDeChef;

        return $this;
    }

    public function getDateDecisionChef(): ?\DateTimeInterface
    {
        return $this->dateDecisionChef;
    }

    public function setDateDecisionChef(?\DateTimeInterface $dateDecisionChef): self
    {
        $this->dateDecisionChef = $dateDecisionChef;

        return $this;
    }

    public function getObservationDecisionChef(): ?string
    {
        return $this->observationDecisionChef;
    }

    public function setObservationDecisionChef(?string $observationDecisionChef): self
    {
        $this->observationDecisionChef = $observationDecisionChef;

        return $this;
    }

    public function getMotifRejet(): ?string
    {
        return $this->motifRejet;
    }

    public function setMotifRejet(?string $motifRejet): self
    {
        $this->motifRejet = $motifRejet;

        return $this;
    }




}
