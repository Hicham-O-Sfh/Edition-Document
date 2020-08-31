<?php

namespace App\Entity;

use App\Repository\DiplomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiplomeRepository::class)
 */
class Diplome
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
     * @ORM\OneToMany(targetEntity=PersonnelDiplome::class, mappedBy="diplome")
     */
    private $personnelDiplome;

    public function __construct()
    {
        $this->personnelDiplome = new ArrayCollection();
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
     * @return Collection|PersonnelDiplome[]
     */
    public function getPersonnelDiplome(): Collection
    {
        return $this->personnelDiplome;
    }

    public function addPersonnelDiplome(PersonnelDiplome $personnelDiplome): self
    {
        if (!$this->personnelDiplome->contains($personnelDiplome)) {
            $this->personnelDiplome[] = $personnelDiplome;
            $personnelDiplome->setDiplome($this);
        }

        return $this;
    }

    public function removePersonnelDiplome(PersonnelDiplome $personnelDiplome): self
    {
        if ($this->personnelDiplome->contains($personnelDiplome)) {
            $this->personnelDiplome->removeElement($personnelDiplome);
            // set the owning side to null (unless already changed)
            if ($personnelDiplome->getDiplome() === $this) {
                $personnelDiplome->setDiplome(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
    return $this->getLibelleFr();    }
}
