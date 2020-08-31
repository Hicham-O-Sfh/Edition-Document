<?php

namespace App\Entity;

use App\Repository\NatureCongeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NatureCongeRepository::class)
 */
class NatureConge
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
     * @ORM\OneToMany(targetEntity=PersonnelConge::class, mappedBy="natureConge")
     */
    private $personnelConges;

    public function __construct()
    {
        $this->personnelConges = new ArrayCollection();
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
     * @return Collection|PersonnelConge[]
     */
    public function getPersonnelConges(): Collection
    {
        return $this->personnelConges;
    }

    public function addPersonnelConge(PersonnelConge $personnelConge): self
    {
        if (!$this->personnelConges->contains($personnelConge)) {
            $this->personnelConges[] = $personnelConge;
            $personnelConge->setNatureConge($this);
        }

        return $this;
    }

    public function removePersonnelConge(PersonnelConge $personnelConge): self
    {
        if ($this->personnelConges->contains($personnelConge)) {
            $this->personnelConges->removeElement($personnelConge);
            // set the owning side to null (unless already changed)
            if ($personnelConge->getNatureConge() === $this) {
                $personnelConge->setNatureConge(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelleFr();
    }
}
