<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommuneRepository::class)
 */
class Commune
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
    private $communeAr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $communeFr;

    /**
     * @ORM\ManyToOne(targetEntity=Province::class, inversedBy="communes")
     */
    private $province;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommuneAr(): ?string
    {
        return $this->communeAr;
    }

    public function setCommuneAr(?string $communeAr): self
    {
        $this->communeAr = $communeAr;

        return $this;
    }

    public function getCommuneFr(): ?string
    {
        return $this->communeFr;
    }

    public function setCommuneFr(?string $communeFr): self
    {
        $this->communeFr = $communeFr;

        return $this;
    }

    public function getProvince(): ?Province
    {
        return $this->province;
    }

    public function setProvince(?Province $province): self
    {
        $this->province = $province;

        return $this;
    }
}
