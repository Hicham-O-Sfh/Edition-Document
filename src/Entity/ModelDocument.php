<?php

namespace App\Entity;

use App\Repository\ModelDocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModelDocumentRepository::class)
 */
class ModelDocument
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
    private $intitule;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $details;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity=PersonnelDocument::class, mappedBy="modelDocument")
     */
    private $personnelDocuments;

    public function __construct()
    {
        $this->personnelDocuments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(?string $intitule): self
    {
        $this->intitule = $intitule;

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
    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|PersonnelDocument[]
     */
    public function getPersonnelDocuments(): Collection
    {
        return $this->personnelDocuments;
    }

    public function addPersonnelDocument(PersonnelDocument $personnelDocument): self
    {
        if (!$this->personnelDocuments->contains($personnelDocument)) {
            $this->personnelDocuments[] = $personnelDocument;
            $personnelDocument->setModelDocument($this);
        }

        return $this;
    }

    public function removePersonnelDocument(PersonnelDocument $personnelDocument): self
    {
        if ($this->personnelDocuments->contains($personnelDocument)) {
            $this->personnelDocuments->removeElement($personnelDocument);
            // set the owning side to null (unless already changed)
            if ($personnelDocument->getModelDocument() === $this) {
                $personnelDocument->setModelDocument(null);
            }
        }

        return $this;
    }
}
