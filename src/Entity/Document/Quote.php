<?php

namespace App\Entity\Document;

use App\Repository\Document\QuoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuoteRepository::class)]
class Quote extends Document
{
}
