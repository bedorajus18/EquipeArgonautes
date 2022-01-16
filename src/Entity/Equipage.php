<?php

namespace App\Entity;

use App\Repository\EquipageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipageRepository::class)
 */
class Equipage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $membre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qualificatif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembre(): ?string
    {
        return $this->membre;
    }

    public function setMembre(string $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getQualificatif(): ?string
    {
        return $this->qualificatif;
    }

    public function setQualificatif(?string $qualificatif): self
    {
        $this->qualificatif = $qualificatif;

        return $this;
    }
}
