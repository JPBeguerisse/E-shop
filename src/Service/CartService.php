<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Products;


class CartService {
    private RequestStack $requestStack;
    private EntityManagerInterface $em;
    public function __construct (RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
    }
    public function addToCart(int $id) {
        $card = $this->requestStack->getSession()->get('cart', []);
        if(!empty($card[$id]))
        {
            $card[$id]++;
        }else{
            $card[$id] = 1;
        }
        $this->getSession()->set('cart', $card);
    }


    public function getTotal() : array
    {
        $cart = $this->getSession()->get('cart');
        $cartData = [];
        if($cart){
            foreach($cart as $id => $quantity)
            {
                $product = $this->em->getRepository(Products::class)->findOneBy(['id' => $id]);
                if(!$product)
                {

                }
                $cartData[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
            }
        }
        return $cartData;
        
    }


    public function removeToCart(int $id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);
        unset($cart[$id]);
        return $this->getSession()->set('cart', $cart);
    }


    public function removeAll()
    {
        return $this->getSession()->remove('cart');
    }

    private function getsession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }

    public function decrease(int $id)
    {
        $cart = $this->getSession()->get('cart', []);
        if ($cart[$id] > 1) {
            $cart[$id]--;
        } else {
            unset($cart[$id]);
        }
        $this->getSession()->set('cart', $cart);
    }

}