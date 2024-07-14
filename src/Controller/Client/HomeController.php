<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/client')]
#[IsGranted('ROLE_CUSTOMER')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'customer_index')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig');
    }
}
