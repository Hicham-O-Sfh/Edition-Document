<?php

namespace App\Entity;

use App\Repository\DocumentExterneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentExterneRepository::class)
 */
class DocumentExterne
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
     * @ORM\OneToMany(targetEntity=PersonnelDocumentExterne::class, mappedBy="documentExterne")
     */
    private $personnelDocumentExternes;

    public function __construct()
    {
        $this->personnelDocumentExternes = new ArrayCollection();
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
     * @return Collection|PersonnelDocumentExterne[]
     */
    public function getPersonnelDocumentExternes(): Collection
    {
        return $this->personnelDocumentExternes;
    }

    public function addPersonnelDocumentExterne(PersonnelDocumentExterne $personnelDocumentExterne): self
    {
        if (!$this->personnelDocumentExternes->contains($personnelDocumentExterne)) {
            $this->personnelDocumentExternes[] = $personnelDocumentExterne;
            $personnelDocumentExterne->setDocumentExterne($this);
        }

        return $this;
    }

    public function removePersonnelDocumentExterne(PersonnelDocumentExterne $personnelDocumentExterne): self
    {
        if ($this->personnelDocumentExternes->contains($personnelDocumentExterne)) {
            $this->personnelDocumentExternes->removeElement($personnelDocumentExterne);
            // set the owning side to null (unless already changed)
            if ($personnelDocumentExterne->getDocumentExterne() === $this) {
                $personnelDocumentExterne->setDocumentExterne(null);
            }
        }

        return $this;
    }
}
