<?php

namespace App\Entity;

use App\Repository\PersonnelDocumentExterneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnelDocumentExterneRepository::class)
 */
class PersonnelDocumentExterne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class, inversedBy="personnelDocumentExternes")
     */
    private $personnel;

    /**
     * @ORM\ManyToOne(targetEntity=DocumentExterne::class, inversedBy="personnelDocumentExternes")
     */
    private $documentExterne;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cheminDoc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;



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

    public function getDocumentExterne(): ?DocumentExterne
    {
        return $this->documentExterne;
    }

    public function setDocumentExterne(?DocumentExterne $documentExterne): self
    {
        $this->documentExterne = $documentExterne;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getCheminDoc(): ?string
    {
        return $this->cheminDoc;
    }

    public function setCheminDoc(?string $cheminDoc): self
    {
        $this->cheminDoc = $cheminDoc;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

   
}
