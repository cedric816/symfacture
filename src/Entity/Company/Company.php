<?php

namespace App\Entity\Company;

use App\Entity\Address;
use App\Entity\Company\Catalog\Catalog;
use App\Entity\User\Customer;
use App\Entity\User\Professional;
use App\Repository\Company\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    public const COMPANY_TYPE_EI = 'EI';
    public const COMPANY_TYPE_EIRL = 'EIRL';
    public const COMPANY_TYPE_EURL = 'EURL';
    public const COMPANY_TYPE_SARL = 'SARL';
    public const COMPANY_TYPE_SAS = 'SAS';
    public const COMPANY_TYPE_SASU = 'SASU';
    public const COMPANY_TYPE_SA = 'SA';
    public const COMPANY_TYPE_SNC = 'SNC';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vatNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $socialAddress = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $billingAddress = null;

    #[ORM\ManyToOne(inversedBy: 'companies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professional $professional = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $colorPrimary = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $colorSecondary = null;

    /**
     * @var Collection <int, Catalog>
     */
    #[ORM\OneToMany(targetEntity: Catalog::class, mappedBy: 'company', orphanRemoval: true)]
    private Collection $catalogs;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $deliveryAddress = null;

    /**
     * @var Collection <int, Customer>
     */
    #[ORM\ManyToMany(targetEntity: Customer::class, mappedBy: 'company')]
    private Collection $customers;

    public function __construct()
    {
        $this->catalogs = new ArrayCollection();
        $this->customers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(?string $vatNumber): static
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

    public function getSocialAddress(): ?Address
    {
        return $this->socialAddress;
    }

    public function setSocialAddress(Address $socialAddress): static
    {
        $this->socialAddress = $socialAddress;

        return $this;
    }

    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(Address $billingAddress): static
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    public function getProfessional(): ?Professional
    {
        return $this->professional;
    }

    public function setProfessional(?Professional $professional): static
    {
        $this->professional = $professional;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getColorPrimary(): ?string
    {
        return $this->colorPrimary;
    }

    public function setColorPrimary(?string $colorPrimary): static
    {
        $this->colorPrimary = $colorPrimary;

        return $this;
    }

    public function getColorSecondary(): ?string
    {
        return $this->colorSecondary;
    }

    public function setColorSecondary(?string $colorSecondary): static
    {
        $this->colorSecondary = $colorSecondary;

        return $this;
    }

    /**
     * @return Collection<int, Catalog>
     */
    public function getCatalogs(): Collection
    {
        return $this->catalogs;
    }

    public function addCatalog(Catalog $catalog): static
    {
        if (!$this->catalogs->contains($catalog)) {
            $this->catalogs->add($catalog);
            $catalog->setCompany($this);
        }

        return $this;
    }

    public function removeCatalog(Catalog $catalog): static
    {
        if ($this->catalogs->removeElement($catalog)) {
            // set the owning side to null (unless already changed)
            if ($catalog->getCompany() === $this) {
                $catalog->setCompany(null);
            }
        }

        return $this;
    }

    public function getDeliveryAddress(): ?Address
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(Address $deliveryAddress): static
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): static
    {
        if (!$this->customers->contains($customer)) {
            $this->customers->add($customer);
            $customer->addCompany($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): static
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeCompany($this);
        }

        return $this;
    }
}
