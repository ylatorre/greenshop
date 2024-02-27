<?php

namespace App\Controller;

use App\Entity\VarianteProduit;
use App\Form\VarianteProduitType;
use App\Repository\VarianteProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/variante/produit')]
class VarianteProduitController extends AbstractController
{
    #[Route('/', name: 'app_variante_produit_index', methods: ['GET'])]
    public function index(VarianteProduitRepository $varianteProduitRepository): Response
    {
        return $this->render('variante_produit/index.html.twig', [
            'variante_produits' => $varianteProduitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_variante_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $varianteProduit = new VarianteProduit();
        $form = $this->createForm(VarianteProduitType::class, $varianteProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($varianteProduit);
            $entityManager->flush();

            return $this->redirectToRoute('app_variante_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('variante_produit/new.html.twig', [
            'variante_produit' => $varianteProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_variante_produit_show', methods: ['GET'])]
    public function show(VarianteProduit $varianteProduit): Response
    {
        return $this->render('variante_produit/show.html.twig', [
            'variante_produit' => $varianteProduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_variante_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VarianteProduit $varianteProduit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VarianteProduitType::class, $varianteProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_variante_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('variante_produit/edit.html.twig', [
            'variante_produit' => $varianteProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_variante_produit_delete', methods: ['POST'])]
    public function delete(Request $request, VarianteProduit $varianteProduit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$varianteProduit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($varianteProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_variante_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
