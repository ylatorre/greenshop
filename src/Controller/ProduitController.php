<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}



class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request): Response
    {
        // ... votre code existant

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request): Response
    {
        // Récupérer la requête de recherche depuis le formulaire
        $searchQuery = $request->query->get('q');

        // Utiliser Doctrine pour rechercher les produits correspondant à la requête
        $entityManager = $this->getDoctrine()->getManager();
        $produits = $entityManager->getRepository(Produit::class)->findBySearchQuery($searchQuery);

        // Passer les résultats à la vue
        return $this->render('search/results.html.twig', [
            'produits' => $produits,
            'searchQuery' => $searchQuery,
        ]);
    }
}
