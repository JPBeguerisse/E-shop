<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Users;
use App\Controller\SecurityController;

use App\Form\AddressType;
use App\Repository\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/addres')]
class AddresController extends AbstractController
{
    #[Route('/add/address', name: 'address_index', methods: ['GET'])]
    public function index(AddressRepository $addressRepository): Response
    {
        return $this->render('addres/index.html.twig', [
            'addresses' => $addressRepository->findAll(),
        ]);
    }

    //Pour pouvoir permettre à l'untilisateur d'ajouter une nouvelle address
    #[Route('/new', name: 'app_addres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AddressRepository $addressRepository, SecurityController $security): Response
    {
        $user = $security->getUser(); // Récupère l'utilisateur actuellement connecté
        $address = new Address();
        $address->setUser($user); // Attribue l'utilisateur à l'adresse

        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addressRepository->save($address, true);

            return $this->redirectToRoute('order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('addres/new.html.twig', [
            'address' => $address,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_addres_show', methods: ['GET'])]
    public function show(Address $address): Response
    {
        return $this->render('addres/show.html.twig', [
            'address' => $address,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_addres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Address $address, AddressRepository $addressRepository): Response
    {
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addressRepository->save($address, true);

            return $this->redirectToRoute('app_addres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('addres/edit.html.twig', [
            'address' => $address,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_addres_delete', methods: ['POST'])]
    public function delete(Request $request, Address $address, AddressRepository $addressRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$address->getId(), $request->request->get('_token'))) {
            $addressRepository->remove($address, true);
        }

        return $this->redirectToRoute('app_addres_index', [], Response::HTTP_SEE_OTHER);
    }
}
