<?php

namespace App\Controller\Pro;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/professionnel/clients')]
#[IsGranted('ROLE_PROFESSIONAL')]
class CustomerController extends AbstractController
{
    #[Route('/', name: 'professional_customer_index')]
    public function index(): Response
    {
        return $this->render('pro/customer/index.html.twig');
    }
}
