<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;
use App\Entity\Liste;
use App\Form\ListeType;
use App\Repository\ListeRepository;
use App\Repository\FicheProduitRepository;
use App\Entity\FicheProduit;



class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categorieRepository = $entityManager->getRepository(Categorie::class);
        $categories = $categorieRepository->findAll();

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'categories' => $categories
        ]);
    }

    #[Route('/categorie/{id}', name: 'categorie_show')]
public function categorie(int $id, EntityManagerInterface $entityManager): Response
{
    $categorieRepository = $entityManager->getRepository(Categorie::class);
    $categorie = $categorieRepository->find($id);

    if (!$categorie) {
        throw $this->createNotFoundException('La catégorie demandée n\'existe pas.');
    }

    $produits = $categorie->getFicheProduits();

    return $this->render('categorie/show.html.twig', [
        'categorie' => $categorie,
        'produits' => $produits,
    ]);
}


#[Route('/ajouter-au-panier/{idProduit}', name: 'ajouter_au_panier')]
public function ajouterAuPanier($idProduit, ListeRepository $listeRepository, FicheProduitRepository $ficheProduitRepository, EntityManagerInterface $entityManager): Response
{
    $user = $this->getUser();
    if (!$user) {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        return $this->redirectToRoute('app_login');
    }

    // Trouver le produit à ajouter
    $produit = $ficheProduitRepository->find($idProduit);
    if (!$produit) {
        // Gérer le cas où le produit n'est pas trouvé
        return $this->redirectToRoute('homepage'); // Exemple de redirection
    }

    // Trouver ou créer le panier de l'utilisateur
    $panier = $listeRepository->findOneBy(['user' => $user, 'typeListe' => 'PANIER']);
    if (!$panier) {
        $panier = new Liste();
        $panier->setUser($user);
        $panier->setTypeListe('PANIER');
        $entityManager->persist($panier);
    }

    // Ajouter le produit au panier
    $panier->addFicheProduit($produit);

    $entityManager->flush();

    return $this->redirectToRoute('app_mon_panier');
}


}
