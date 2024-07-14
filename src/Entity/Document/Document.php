<?php

namespace App\Entity\Document;

use App\Repository\Document\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'type', type: 'string')]
#[DiscriminatorMap(['invoice' => Invoice::class, 'quote' => Quote::class])]
abstract class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numbering = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    /**
     * @var Collection <int, Line>
     */
    #[ORM\OneToMany(targetEntity: Line::class, mappedBy: 'document', orphanRemoval: true)]
    private Collection $items;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyInfo $companyInfo = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?CustomerInfo $customerInfo = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumbering(): ?string
    {
        return $this->numbering;
    }

    public function setNumbering(string $numbering): static
    {
        $this->numbering = $numbering;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Line>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Line $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setDocument($this);
        }

        return $this;
    }

    public function removeItem(Line $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getDocument() === $this) {
                $item->setDocument(null);
            }
        }

        return $this;
    }

    public function getCompanyInfo(): ?CompanyInfo
    {
        return $this->companyInfo;
    }

    public function setCompanyInfo(CompanyInfo $companyInfo): static
    {
        $this->companyInfo = $companyInfo;

        return $this;
    }

    public function getCustomerInfo(): ?CustomerInfo
    {
        return $this->customerInfo;
    }

    public function setCustomerInfo(CustomerInfo $customerInfo): static
    {
        $this->customerInfo = $customerInfo;

        return $this;
    }
}
