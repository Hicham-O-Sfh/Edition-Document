<?php

namespace App\Entity;

use App\Repository\PersonnelMissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnelMissionRepository::class)
 */
class PersonnelMission
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class, inversedBy="personnelMissions")
     */
    private $personnel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $destination;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $moyenTransport;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRetour;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $decisionChef = 'encours';

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
    private $motifAnnulation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libeleMissionFR;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libeleMissionAR;

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
    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(?string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getMoyenTransport(): ?string
    {
        return $this->moyenTransport;
    }

    public function setMoyenTransport(?string $moyenTransport): self
    {
        $this->moyenTransport = $moyenTransport;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(?\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(?\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

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

    public function getDecisionChef(): ?string
    {
        return $this->decisionChef;
    }

    public function setDecisionChef(?string $decisionChef): self
    {
        $this->decisionChef = $decisionChef;

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

    public function getMotifAnnulation(): ?string
    {
        return $this->motifAnnulation;
    }

    public function setMotifAnnulation(?string $motifAnnulation): self
    {
        $this->motifAnnulation = $motifAnnulation;

        return $this;
    }

    public function getLibeleMissionFR(): ?string
    {
        return $this->libeleMissionFR;
    }

    public function setLibeleMissionFR(?string $libeleMissionFR): self
    {
        $this->libeleMissionFR = $libeleMissionFR;

        return $this;
    }

    public function getLibeleMissionAR(): ?string
    {
        return $this->libeleMissionAR;
    }

    public function setLibeleMissionAR(?string $libeleMissionAR): self
    {
        $this->libeleMissionAR = $libeleMissionAR;

        return $this;
    }
}
