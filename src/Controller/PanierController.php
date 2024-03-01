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


#[Route('/supprimer/{id}', name: 'supprimer_produit_panier', methods: ['POST'])]
    public function supprimerProduitPanier(Request $request, FicheProduitRepository $ficheProduitRepository): Response
    {
        $id = $request->attributes->get('id');

        $user = $this->getUser();
        if (!$user) {
            // Redirigez vers la page de connexion ou toute autre page appropriée
            return $this->redirectToRoute('app_login');
        }

        $panier = $this->entityManager->getRepository(Liste::class)->findOneBy(['user' => $user, 'typeListe' => 'PANIER']);

        if (!$panier) {
            // Gérer le cas où le panier n'est pas trouvé
            // Peut-être rediriger vers la page du panier avec un message d'erreur
        }

        $ficheProduit = $ficheProduitRepository->find($id);

        if (!$ficheProduit) {
            // Gérer le cas où le produit n'est pas trouvé
            // Peut-être rediriger vers la page du panier avec un message d'erreur
        }

        $panier->removeFicheProduit($ficheProduit);
        $this->entityManager->flush();

        // Rediriger vers la page du panier
        return $this->redirectToRoute('app_mon_panier');
    }


    #[Route('/update-quantity', name: 'update_quantity', methods: ['POST'])]
    public function updateQuantity(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer la nouvelle quantité depuis la requête
        $newQuantity = $request->request->getInt('quantity');
        $produitId = $request->request->getInt('produit_id'); // Ajoutez cette ligne si nécessaire
    
        // Récupérer le produit à partir de l'ID (vous pouvez également passer l'ID en tant que paramètre dans l'URL si vous préférez)
        $produit = $entityManager->getRepository(FicheProduit::class)->find($produitId);
    
        // Vérifier si le produit existe
        if (!$produit) {
            return new JsonResponse(['success' => false, 'message' => 'Produit non trouvé']);
        }
    
        // Mettre à jour la quantité du produit
        $produit->setQuantite($newQuantity);
    
        // Enregistrer les changements dans la base de données
        $entityManager->flush();
    
        // Retourner une réponse JSON indiquant le succès de la mise à jour
        return new JsonResponse(['success' => true]);
    }

}
