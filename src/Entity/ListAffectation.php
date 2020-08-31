<?php

namespace App\Entity;

use App\Repository\ListAffectationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListAffectationRepository::class)
 */
class ListAffectation
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
     * @ORM\OneToMany(targetEntity=PersonnelFonction::class, mappedBy="lieuaffectation")
     */
    private $personnelFonctions;

    /**
     * @ORM\OneToMany(targetEntity=MouvementPersonnel::class, mappedBy="lieuAffectation")
     */
    private $mouvementPersonnels;

    public function __construct()
    {
        $this->personnelFonctions = new ArrayCollection();
        $this->mouvementPersonnels = new ArrayCollection();
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

    /**
     * @return Collection|PersonnelFonction[]
     */
    public function getPersonnelFonctions(): Collection
    {
        return $this->personnelFonctions;
    }

    public function addPersonnelFonction(PersonnelFonction $personnelFonction): self
    {
        if (!$this->personnelFonctions->contains($personnelFonction)) {
            $this->personnelFonctions[] = $personnelFonction;
            $personnelFonction->setAffectation($this);
        }

        return $this;
    }

    public function removePersonnelFonction(PersonnelFonction $personnelFonction): self
    {
        if ($this->personnelFonctions->contains($personnelFonction)) {
            $this->personnelFonctions->removeElement($personnelFonction);
            // set the owning side to null (unless already changed)
            if ($personnelFonction->getAffectation() === $this) {
                $personnelFonction->setAffectation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MouvementPersonnel[]
     */
    public function getMouvementPersonnels(): Collection
    {
        return $this->mouvementPersonnels;
    }

    public function addMouvementPersonnel(MouvementPersonnel $mouvementPersonnel): self
    {
        if (!$this->mouvementPersonnels->contains($mouvementPersonnel)) {
            $this->mouvementPersonnels[] = $mouvementPersonnel;
            $mouvementPersonnel->setLieuAffectation($this);
        }

        return $this;
    }

    public function removeMouvementPersonnel(MouvementPersonnel $mouvementPersonnel): self
    {
        if ($this->mouvementPersonnels->contains($mouvementPersonnel)) {
            $this->mouvementPersonnels->removeElement($mouvementPersonnel);
            // set the owning side to null (unless already changed)
            if ($mouvementPersonnel->getLieuAffectation() === $this) {
                $mouvementPersonnel->setLieuAffectation(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelleFr();
    }
}
