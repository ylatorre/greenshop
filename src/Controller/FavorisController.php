<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ListeRepository; // Assurez-vous d'importer le bon repository


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



    
}
