<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Liste;
use App\Repository\ListeRepository;

class PaiementController extends AbstractController
{
    #[Route('/create-checkout-session', name: 'paiement')]
    public function createCheckoutSession(ListeRepository $listeRepository): Response
    {


        $user = $this->getUser();
    if (!$user) {
        return new JsonResponse(['error' => 'Utilisateur non connecté'], Response::HTTP_FORBIDDEN);
    }

    // Supposons que vous avez une méthode pour obtenir le panier de l'utilisateur
    $panier = $listeRepository->findOneBy(['user' => $user, 'typeListe' => 'PANIER']);

    if (!$panier) {
        return new JsonResponse(['error' => 'Panier introuvable'], Response::HTTP_NOT_FOUND);
    }

    $prixTotalCentimes = 0;
    foreach ($panier->getFicheProduits() as $produit) {
        $prixTotalCentimes += ($produit->getPrix() * 100);
    }

        \Stripe\Stripe::setApiKey($this->getParameter('stripe_secret_key'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => $prixTotalCentimes,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
        ]);

        return new JsonResponse(['id' => $session->id]);

    }
    
}
    
