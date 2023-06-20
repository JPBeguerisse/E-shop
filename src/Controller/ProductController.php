<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductRepository;
use App\Entity\Products;

class ProductController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'shop_index')]
    public function index(): Response
    {
        $products = $this->em->getRepository(Products::class)->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);    
    }
}
