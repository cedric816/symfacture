<?php

namespace App\Entity\User;

use App\Entity\Address;
use App\Entity\Company\Company;
use App\Repository\User\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer extends User
{
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $deliveryAddress = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $billingAddress = null;

    /**
     * @var Collection <int, Company>
     */
    #[ORM\ManyToMany(targetEntity: Company::class, inversedBy: 'customers')]
    private Collection $companies;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
    }

    public function getDeliveryAddress(): ?Address
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(?Address $deliveryAddress): static
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(?Address $billingAddress): static
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompany(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): static
    {
        if (!$this->companies->contains($company)) {
            $this->companies->add($company);
        }

        return $this;
    }

    public function removeCompany(Company $company): static
    {
        $this->companies->removeElement($company);

        return $this;
    }
}
