<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\FicheProduit;
use Symfony\Component\HttpFoundation\Request;




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

    #[Route('/produit/{id}', name: 'produit_show')]
public function show(int $id, EntityManagerInterface $entityManager): Response
{
    $product = $entityManager->getRepository(FicheProduit::class)->find($id);

    if (!$product) {
        throw $this->createNotFoundException('No product found for id '.$id);
    }

    return $this->render('produit/article.html.twig', ['product' => $product]);
}


#[Route('/search', name: 'search')]
public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        $searchQuery = $request->query->get('q');
        $ficheProduits = $entityManager->getRepository(FicheProduit::class)->findBySearchQuery($searchQuery);

        return $this->render('produit/results.html.twig', [
            'ficheProduits' => $ficheProduits,
            'searchQuery' => $searchQuery,
        ]);
    }

    

}



