<?php

namespace App\Entity;

use App\Repository\MotifRejetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MotifRejetRepository::class)
 */
class MotifRejet
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
    private $libelleAr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelleFr;

    /**
     * @ORM\OneToMany(targetEntity=Personnel::class, mappedBy="motif")
     */
    private $personnels;

    public function __construct()
    {
        $this->personnels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLibelleFr(): ?string
    {
        return $this->libelleFr;
    }

    public function setLibelleFr(?string $libelleFr): self
    {
        $this->libelleFr = $libelleFr;

        return $this;
    }

    /**
     * @return Collection|Personnel[]
     */
    public function getPersonnels(): Collection
    {
        return $this->personnels;
    }

    public function addPersonnel(Personnel $personnel): self
    {
        if (!$this->personnels->contains($personnel)) {
            $this->personnels[] = $personnel;
            $personnel->setMotif($this);
        }

        return $this;
    }

    public function removePersonnel(Personnel $personnel): self
    {
        if ($this->personnels->contains($personnel)) {
            $this->personnels->removeElement($personnel);
            // set the owning side to null (unless already changed)
            if ($personnel->getMotif() === $this) {
                $personnel->setMotif(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
       return $this->getLibelleFr()."";
    }


}
