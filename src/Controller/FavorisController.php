<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ListeRepository; // Assurez-vous d'importer le bon repository
use App\Repository\FicheProduitRepository;
use Doctrine\ORM\EntityManagerInterface;

class FavorisController extends AbstractController
{
    #[Route('/favoris', name: 'app_favoris', methods: ['GET'])]
    public function mesFavoris(ListeRepository $listeRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            // Redirigez vers la page de connexion ou toute autre page appropriée
            return $this->redirectToRoute('app_login');
        }

        // Cherchez la liste de favoris de l'utilisateur au lieu du panier
        $favoris = $listeRepository->findOneBy(['user' => $user, 'typeListe' => 'FAVORIS']);

        // Vous pourriez vouloir compter simplement le nombre de favoris, ou autre chose
        // Ici, nous allons simplement transmettre les favoris à la vue sans calculer de prix total
        return $this->render('favoris/index.html.twig', [
            'favoris' => $favoris,
        ]);

    }
    #[Route('/ajouter-aux-favoris/{idProduit}', name: 'ajouter_aux_favoris')]
    public function ajouterAuxFavoris($idProduit, FicheProduitRepository $produitRepository, EntityManagerInterface $entityManager, ListeRepository $listeRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $produit = $produitRepository->find($idProduit);
        if (!$produit) {
            return $this->redirectToRoute('homepage');
        }

        // Trouver ou créer la liste de favoris pour l'utilisateur
        $favoris = $listeRepository->findOneBy(['user' => $user, 'typeListe' => 'FAVORIS']);
        if (!$favoris) {
            // Assumer ici que Liste est votre entité représentant une liste et qu'elle a une méthode setTypeListe
            $favoris = new Liste(); // Assurez-vous que c'est le bon nom d'entité
            $favoris->setUser($user);
            $favoris->setTypeListe('FAVORIS');
            $entityManager->persist($favoris);
        }

        // Assumer que Liste a une méthode pour ajouter un produit aux favoris
        $favoris->addFicheProduit($produit); // Adaptez cette ligne en fonction de votre implémentation
        $entityManager->flush();

        return $this->redirectToRoute('app_favoris'); // Utilisez le nom de la route
    }
}



    
