<?php

namespace App\Entity\Document;

use App\Repository\Document\CustomerInfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerInfoRepository::class)]
class CustomerInfo extends Info
{
}
