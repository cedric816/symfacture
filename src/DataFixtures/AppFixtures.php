<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Company\Catalog\Catalog;
use App\Entity\Company\Catalog\Category;
use App\Entity\Company\Catalog\Product;
use App\Entity\Company\Company;
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
        $customers = [];

        for ($i = 1; $i <= 50; $i++) {
            $customerDeliveryAdress = new Address();
            $customerDeliveryAdress
                ->setNumber("$i")
                ->setStreet('rue Livraison'.$i)
                ->setPostalCode(rand(10000, 90000))
                ->setCity('Ville'.$i);
            $manager->persist($customerDeliveryAdress);

            $customerBillingAddress = new Address();
            $customerBillingAddress
                ->setNumber("$i")
                ->setStreet('rue Facturation'.$i)
                ->setPostalCode(rand(10000, 90000))
                ->setCity('Ville'.$i);
            $manager->persist($customerBillingAddress);

            $customer = new Customer();
            $customer
                ->setRoles(['ROLE_CUSTOMER'])
                ->setEmail('client'.$i.'@mail.fr')
                ->setPassword($this->passwordHasher->hashPassword($customer, 'pass'))
                ->setFirstName('Prénom'.$i)
                ->setLastName('Nom'.$i)
                ->setPhone('0605040302')
                ->setDeliveryAddress($customerDeliveryAdress)
                ->setBillingAddress($customerBillingAddress);
            $manager->persist($customer);

            $customers[] = $customer;
        }

        $professional = new Professional();
        $professional
            ->setRoles(['ROLE_PROFESSIONAL'])
            ->setEmail('pro@mail.fr')
            ->setPassword($this->passwordHasher->hashPassword($professional, 'pass'))
            ->setFirstName('Ced')
            ->setLastName('Lepro');
        for ($i = 0; $i <= 30; $i++) {
            $professional->addCustomer($customers[$i]);
        }
        $manager->persist($professional);

        $professional2 = new Professional();
        $professional2
            ->setRoles(['ROLE_PROFESSIONAL'])
            ->setEmail('pro2@mail.fr')
            ->setPassword($this->passwordHasher->hashPassword($professional, 'pass'))
            ->setFirstName('Ced2')
            ->setLastName('Lepro2');
        $manager->persist($professional2);

        $companySocialAddress = new Address();
        $companySocialAddress
            ->setNumber('1')
            ->setStreet('rue siège social')
            ->setPostalCode(30000)
            ->setCity('Nîmes');
        $manager->persist($companySocialAddress);

        $companyBillingAddress = new Address();
        $companyBillingAddress
            ->setNumber('1')
            ->setStreet('rue facturation')
            ->setPostalCode(30000)
            ->setCity('Nîmes');
        $manager->persist($companyBillingAddress);

        $companyDeliveryAddress = new Address();
        $companyDeliveryAddress
            ->setNumber('1')
            ->setStreet('rue livraison')
            ->setPostalCode(30000)
            ->setCity('Nîmes');
        $manager->persist($companyDeliveryAddress);

        $company1 = new Company();
        $company1
            ->setProfessional($professional)
            ->setType(Company::COMPANY_TYPE_EIRL)
            ->setName('Ets CED')
            ->setSiret('362 521 879 00034')
            ->setSocialAddress($companySocialAddress)
            ->setBillingAddress($companyBillingAddress)
            ->setDeliveryAddress($companyDeliveryAddress)
            ->addCustomer($customer);
        $manager->persist($company1);

        $catalog = new Catalog();
        $catalog
            ->setCompany($company1)
            ->setName('Catalogue pièces détachées');
        $manager->persist($catalog);

        $categoryA = new Category();
        $categoryA
            ->setName('Catégorie A')
            ->setDescription('description de la catégoerie A');
        $manager->persist($categoryA);

        $categoryB = new Category();
        $categoryB
            ->setName('Catégorie B')
            ->setDescription('description de la catégoerie B');
        $manager->persist($categoryB);

        $categories = [$categoryA, $categoryB];

        for ($i = 1; $i <= 50; $i++) {
            $product = new Product();
            $product
                ->setCatalog($catalog)
                ->setName('produit '.$i)
                ->setVat(0.2)
                ->setPriceHt(rand(10, 10000))
                ->setReference('ref'.$i)
                ->setDescription('description du produit réf: ref'.$i);
            if ($i % 2 === 0) {
                $product->addCategory($categories[0]);
            } else {
                $product->addCategory($categories[1]);
            }
            $manager->persist($product);
        }

        $manager->flush();
    }
}
