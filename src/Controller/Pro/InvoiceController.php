<?php

namespace App\Controller\Pro;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/professionnel/factures')]
#[IsGranted('ROLE_PROFESSIONAL')]
class InvoiceController extends AbstractController
{
    #[Route('/', name: 'professional_invoice_index')]
    public function index(): Response
    {
        return $this->render('pro/invoice/index.html.twig');
    }
}
