<?php

namespace App\Entity;

use App\Repository\SecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SecteurRepository::class)
 */
class Secteur
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
    private $libelleFr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelleAr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fixe1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fixe2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gsm1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gsm2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @ORM\OneToMany(targetEntity=Personnel::class, mappedBy="secteur")
     */
    private $Personnels;

    /**
     * @ORM\OneToOne(targetEntity=Personnel::class, cascade={"persist", "remove"})
     */
    private $animateur;

    public function __construct()
    {
        $this->Personnels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleFr(): ?string
    {
        return $this->libelleFr;
    }

    public function setLibelleFr(?string $libelleFr): self
    {
        $this->libelleFr = $libelleFr;

        return $this;
    }

    public function getLibelleAr(): ?string
    {
        return $this->libelleAr;
    }

    public function setLibelleAr(?string $libelleAr): self
    {
        $this->libelleAr = $libelleAr;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail1(): ?string
    {
        return $this->email1;
    }

    public function setEmail1(?string $email1): self
    {
        $this->email1 = $email1;

        return $this;
    }

    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    public function setEmail2(?string $email2): self
    {
        $this->email2 = $email2;

        return $this;
    }

    public function getFixe1(): ?string
    {
        return $this->fixe1;
    }

    public function setFixe1(?string $fixe1): self
    {
        $this->fixe1 = $fixe1;

        return $this;
    }

    public function getFixe2(): ?string
    {
        return $this->fixe2;
    }

    public function setFixe2(?string $fixe2): self
    {
        $this->fixe2 = $fixe2;

        return $this;
    }

    public function getGsm1(): ?string
    {
        return $this->gsm1;
    }

    public function setGsm1(?string $gsm1): self
    {
        $this->gsm1 = $gsm1;

        return $this;
    }

    public function getGsm2(): ?string
    {
        return $this->gsm2;
    }

    public function setGsm2(?string $gsm2): self
    {
        $this->gsm2 = $gsm2;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return Collection|Personnel[]
     */
    public function getPersonnels(): Collection
    {
        return $this->Personnels;
    }

    public function addPersonnel(Personnel $personnel): self
    {
        if (!$this->Personnels->contains($personnel)) {
            $this->Personnels[] = $personnel;
            $personnel->setSecteur($this);
        }

        return $this;
    }

    public function removePersonnel(Personnel $personnel): self
    {
        if ($this->Personnels->contains($personnel)) {
            $this->Personnels->removeElement($personnel);
            // set the owning side to null (unless already changed)
            if ($personnel->getSecteur() === $this) {
                $personnel->setSecteur(null);
            }
        }

        return $this;
    }

    public function getAnimateur(): ?Personnel
    {
        return $this->animateur;
    }

    public function setAnimateur(?Personnel $animateur): self
    {
        $this->animateur = $animateur;

        return $this;
    }

    public function __toString()
    {
       return $this->getLibelleFr();
    }
}
