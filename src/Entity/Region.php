<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
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
    private $regionFr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $regionAr;

    /**
     * @ORM\OneToMany(targetEntity=Province::class, mappedBy="region")
     */
    private $provinces;

    public function __construct()
    {
        $this->provinces = new ArrayCollection();
    }

    public function getRegionFr(): ?string
    {
        return $this->regionFr;
    }

    public function setRegionFr(?string $regionFr): self
    {
        $this->regionFr = $regionFr;

        return $this;
    }

    public function getRegionAr(): ?string
    {
        return $this->regionAr;
    }

    public function setRegionAr(?string $regionAr): self
    {
        $this->regionAr = $regionAr;

        return $this;
    }

    /**
     * @return Collection|Province[]
     */
    public function getProvinces(): Collection
    {
        return $this->provinces;
    }

    public function addProvince(Province $province): self
    {
        if (!$this->provinces->contains($province)) {
            $this->provinces[] = $province;
            $province->setRegion($this);
        }

        return $this;
    }

    public function removeProvince(Province $province): self
    {
        if ($this->provinces->contains($province)) {
            $this->provinces->removeElement($province);
            // set the owning side to null (unless already changed)
            if ($province->getRegion() === $this) {
                $province->setRegion(null);
            }
        }

        return $this;
    }


}
