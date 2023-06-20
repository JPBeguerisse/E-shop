<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeValidedController extends AbstractController
{
    #[Route('/commande/valided', name: 'valided_index')]
    public function index(): Response
    {
        return $this->render('commande_valided/index.html.twig', [
            'controller_name' => 'CommandeValidedController',
        ]);
    }
}
