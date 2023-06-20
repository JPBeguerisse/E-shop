<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\OrderType;
use App\Service\CartService;


class OrderController extends AbstractController
{
    #[Route('/order/create', name: 'order_index')]
    public function index(CartService $cartService): Response
    {
        //si l'user pas connecter redirect to connexion
        if(!$this->getUser())
        {
            return $this->redirectToRoute('app_login');
        }


        $form = $this->createForm(OrderType::class, null, ['user' => $this->getUser()]);

        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'recapCart' => $cartService->getTotal()
        ]);
    }
    
}
