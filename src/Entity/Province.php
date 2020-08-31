<?php

namespace App\Entity;

use App\Repository\ProvinceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProvinceRepository::class)
 */
class Province
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
    private $provinceAr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $provinceFr;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="provinces")
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity=Commune::class, mappedBy="province")
     */
    private $communes;

    public function __construct()
    {
        $this->communes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvinceAr(): ?string
    {
        return $this->provinceAr;
    }

    public function setProvinceAr(?string $provinceAr): self
    {
        $this->provinceAr = $provinceAr;

        return $this;
    }

    public function getProvinceFr(): ?string
    {
        return $this->provinceFr;
    }

    public function setProvinceFr(?string $provinceFr): self
    {
        $this->provinceFr = $provinceFr;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|Commune[]
     */
    public function getCommunes(): Collection
    {
        return $this->communes;
    }

    public function addCommune(Commune $commune): self
    {
        if (!$this->communes->contains($commune)) {
            $this->communes[] = $commune;
            $commune->setProvince($this);
        }

        return $this;
    }

    public function removeCommune(Commune $commune): self
    {
        if ($this->communes->contains($commune)) {
            $this->communes->removeElement($commune);
            // set the owning side to null (unless already changed)
            if ($commune->getProvince() === $this) {
                $commune->setProvince(null);
            }
        }

        return $this;
    }
}
