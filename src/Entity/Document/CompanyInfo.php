<?php

namespace App\Entity\Document;

use App\Repository\Document\CompanyInfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyInfoRepository::class)]
class CompanyInfo extends Info
{
    #[ORM\Column(length: 255)]
    private ?string $legalType = null;

    #[ORM\Column(length: 255)]
    private ?string $vatNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $professionalName = null;

    public function getLegalType(): ?string
    {
        return $this->legalType;
    }

    public function setLegalType(string $legalType): static
    {
        $this->legalType = $legalType;

        return $this;
    }

    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(string $vatNumber): static
    {
        $this->vatNumber = $vatNumber;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getProfessionalName(): ?string
    {
        return $this->professionalName;
    }

    public function setProfessionalName(string $professionalName): static
    {
        $this->professionalName = $professionalName;

        return $this;
    }
}
