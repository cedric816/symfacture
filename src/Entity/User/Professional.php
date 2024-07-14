<?php

namespace App\Entity\User;

use App\Entity\Company\Company;
use App\Repository\User\ProfessionalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionalRepository::class)]
class Professional extends User
{
    /**
     * @var Collection <int, Company>
     */
    #[ORM\OneToMany(targetEntity: Company::class, mappedBy: 'professional', orphanRemoval: true)]
    private Collection $companies;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): static
    {
        if (!$this->companies->contains($company)) {
            $this->companies->add($company);
            $company->setProfessional($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): static
    {
        if ($this->companies->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getProfessional() === $this) {
                $company->setProfessional(null);
            }
        }

        return $this;
    }
}
