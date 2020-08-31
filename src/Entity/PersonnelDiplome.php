<?php

namespace App\Entity;

use App\Repository\PersonnelDiplomeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnelDiplomeRepository::class)
 */
class PersonnelDiplome
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
    private $designation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateObtention;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etablissement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $specialite;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class, inversedBy="personnelDiplomes")
     */
    private $personnel;

    /**
     * @ORM\ManyToOne(targetEntity=Diplome::class, inversedBy="personnelDiplome")
     */
    private $diplome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cheminDoc;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

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

    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }

    public function setEtablissement(?string $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(?string $specialite): self
    {
        $this->specialite = $specialite;

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

    public function getDiplome(): ?Diplome
    {
        return $this->diplome;
    }

    public function setDiplome(?Diplome $diplome): self
    {
        $this->diplome = $diplome;

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
}
