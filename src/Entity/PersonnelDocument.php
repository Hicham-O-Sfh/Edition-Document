<?php

namespace App\Entity;

use App\Repository\PersonnelDocumentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnelDocumentRepository::class)
 */
class PersonnelDocument
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=ModelDocument::class, inversedBy="personnelDocuments")
     */
    private $modelDocument;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class, inversedBy="personnelDocuments")
     */
    private $personnel;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateObtention;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDemande;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getModelDocument(): ?ModelDocument
    {
        return $this->modelDocument;
    }

    public function setModelDocument(?ModelDocument $modelDocument): self
    {
        $this->modelDocument = $modelDocument;

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

    public function getDateObtention(): ?\DateTimeInterface
    {
        return $this->dateObtention;
    }

    public function setDateObtention(?\DateTimeInterface $dateObtention): self
    {
        $this->dateObtention = $dateObtention;

        return $this;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(?\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

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
}
