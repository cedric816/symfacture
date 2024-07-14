<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\User\Customer;
use App\Entity\User\Professional;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {

    }

    public function load(ObjectManager $manager): void
    {
        $customerDeliveryAdress = new Address();
        $customerDeliveryAdress
            ->setNumber(1)
            ->setStreet('rue Livraison')
            ->setPostalCode(30000)
            ->setCity('Nîmes');
        $manager->persist($customerDeliveryAdress);

        $customerBillingAddress = new Address();
        $customerBillingAddress
            ->setNumber(1)
            ->setStreet('rue Facturation')
            ->setPostalCode(30000)
            ->setCity('Nîmes');
        $manager->persist($customerBillingAddress);

        $customer = new Customer();
        $customer
            ->setRoles(['ROLE_CUSTOMER'])
            ->setEmail('client@mail.fr')
            ->setPassword($this->passwordHasher->hashPassword($customer, 'pass'))
            ->setFirstName('Ced')
            ->setLastName('Leclient')
            ->setPhone('0605040302')
            ->setDeliveryAddress($customerDeliveryAdress)
            ->setBillingAddress($customerBillingAddress);
        $manager->persist($customer);

        $professional = new Professional();
        $professional
            ->setRoles(['ROLE_PROFESSIONAL'])
            ->setEmail('pro@mail.fr')
            ->setPassword($this->passwordHasher->hashPassword($professional, 'pass'))
            ->setFirstName('Ced')
            ->setLastName('Lepro');
        $manager->persist($professional);

        $manager->flush();
    }
}
