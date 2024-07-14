<?php

namespace App\Entity\User;

use App\Repository\User\ProfessionalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionalRepository::class)]
class Professional extends User
{
}
