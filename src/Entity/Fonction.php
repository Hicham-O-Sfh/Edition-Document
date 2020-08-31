<?php

namespace App\Entity;

use App\Repository\FonctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FonctionRepository::class)
 */
class Fonction
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
     * @ORM\OneToMany(targetEntity=PersonnelFonction::class, mappedBy="fonction")
     */
    private $personnelFonctions;


    public function __construct()
    {
        $this->personnelFonctions = new ArrayCollection();
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
            $personnelFonction->setFonction($this);
        }

        return $this;
    }

    public function removePersonnelFonction(PersonnelFonction $personnelFonction): self
    {
        if ($this->personnelFonctions->contains($personnelFonction)) {
            $this->personnelFonctions->removeElement($personnelFonction);
            // set the owning side to null (unless already changed)
            if ($personnelFonction->getFonction() === $this) {
                $personnelFonction->setFonction(null);
            }
        }

        return $this;
    }
public function __toString()
{
    return $this->getLibelleFr();
}
}


 
