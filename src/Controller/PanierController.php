<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Liste;
use App\Repository\ListeRepository;
use App\Repository\FicheProduitRepository;
use App\Entity\FicheProduit;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_mon_panier', methods: ['GET'])]
public function monPanier(ListeRepository $listeRepository): Response
{
    
    $user = $this->getUser();
    if (!$user) {
        // Redirigez vers la page de connexion ou toute autre page appropriée
        return $this->redirectToRoute('app_login');
    }

    $panier = $listeRepository->findOneBy(['user' => $user, 'typeListe' => 'PANIER']);

    $prixTotal = 0;
    if ($panier) {
        foreach ($panier->getFicheProduits() as $produit) {
            $prixTotal += $produit->getPrix();
        }
    }

    return $this->render('panier/index.html.twig', [
        'panier' => $panier,
        'prixTotal' => $prixTotal,
    ]);
}





}
