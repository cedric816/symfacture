<?php

namespace App\Controller\Pro;

use App\Entity\User\Professional;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/professionnel/clients')]
#[IsGranted('ROLE_PROFESSIONAL')]
class CustomerController extends AbstractController
{
    #[Route('/', name: 'professional_customer_index')]
    public function index(#[CurrentUser] Professional $professional, PaginatorInterface $paginator, Request $request): Response
    {
        $customers = $professional->getCustomers();

        $pagination = $paginator->paginate(
            $customers,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('pro/customer/index.html.twig', [
            'pagination' => $pagination
        ]);
    }
}
