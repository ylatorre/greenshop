<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\FicheProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\FicheProduit;


class ProduitController extends AbstractController
{

    #[Route('/produit', name: 'app_produit')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ficheProduitRepository = $entityManager->getRepository(FicheProduit::class);
        $ficheProduits = $ficheProduitRepository->findAll();

        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            'ficheProduits' => $ficheProduits,
        ]);
    }

    #[Route('/article', name: 'affichage_produit')]
    public function AffichageProduit(): Response
    {
        return $this->render('produit/article.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    public function search(Request $request, FicheProduitRepository $FicheProduitRepository): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchTerm = $form->get('search')->getData();

            // Use your repository or service to fetch products based on the search term
            $results = $FicheProduitRepository->findBySearchTerm($searchTerm);

            return $this->render('product/search_results.html.twig', [
                'results' => $results,
            ]);
        }

        return $this->render('product/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}