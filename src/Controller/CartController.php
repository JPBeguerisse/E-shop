<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CartService;

class CartController extends AbstractController
{


    #[Route('/mon-panier', name: 'cart_index')]
    public function index(CartService $cartService): Response
    {    
        //dd($cartService->getTotal());
        return $this->render('cart/index.html.twig', [
            'cart' => $cartService->getTotal()
        ]);
    }


    #[Route('/mon-panier/add/{id<\d+>}', name: 'cart_add')]
    public function addToRoute(CartService $cartService, int $id): Response
    {
        $cartService->addTocart($id);
        
        return $this->redirectToRoute('cart_index');
    }


    #[Route('/mon-panier/remove/{id<\d+>}', name: 'cart_remove')]
    public function removeToCart(CartService $cartService, int $id): Response
    {
        $cartService->removeToCart($id);

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/mon-panier/removeAll', name: 'cart_removeAll')]
    public function removeAll(CartService $cartService): Response
    {
        $cartService->removeAll();
        
        //redirect à la boutique une fois le panier vider
        return $this->redirectToRoute('shop_index');
    }

    #[Route('/mon-panier/decrease/{id<\d+>}', name: 'cart_decrease')]
    public function decrease(CartService $cartService, $id): Response
    {
        $cartService->decrease($id);

        return $this->redirectToRoute('cart_index');
    }
}
