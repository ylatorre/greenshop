<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Liste;
use App\Repository\ListeRepository;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(CommandeRepository $commandeRepository, ListeRepository $listeRepository): Response
    {
        $user = $this->getUser();

        if (!$user instanceof UserInterface) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas connecté.');
        }
        // Récupérer les deux dernières commandes de l'utilisateur
        $commandes = $commandeRepository->findBy(
            ['user' => $user],
            ['createdAt' => 'DESC'],
            2
        );

        // Limiter à deux listes
        $listes = $listeRepository->findBy(['user' => $user], null, 2);

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'listes' => $listes,
            'commandes' => $commandes
        ]);
    }



    #[Route('/compte', name: 'compte')]
    public function compte(): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Assurez-vous qu'un utilisateur est connecté
        if (!$user instanceof UserInterface) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas connecté.');
        }

        // Initialiser la collection d'adresses (forcer le chargement)
        $adresses = $user->getIdAdresse();

        // Vous pouvez utiliser une méthode spécifique dans le repository pour filtrer les adresses actives, par exemple
        // $adressesActives = $adresseRepository->findActiveAdressesByUser($user);

        // Assurez-vous que la collection est initialisée
        if (!$adresses->isInitialized()) {
            $adresses->initialize(); // Force le chargement des ADRESSES
//            dd($adresses);
        }

        // Convertir la collection en tableau si nécessaire, ou passer directement à Twig
        $adressesArray = $adresses->toArray();
//dd($adressesArray);
        return $this->render('user/compte.html.twig', [
            'user' => $user,
            'adresses' => $adressesArray, // Passez les adresses à Twig
        ]);
    }
//    #[Route('/update-compte', name: 'update_route', methods: ['POST'])]
//    public function update(Request $request): JsonResponse
//    {
//        $data = json_decode($request->getContent(), true);
//
//        // Ici, vous récupérez l'utilisateur et mettez à jour ses données
//        $user = $this->getUser(); // Ou utilisez le UserRepository pour trouver l'utilisateur par son ID
//        if (!$user) {
//            return $this->json(['message' => 'Utilisateur non trouvé'], 404);
//        }
//
//        // Exemple de mise à jour d'un champ
//        $user->setEmail($data['email']);
//        // Répétez pour les autres champs...
//
//        // Sauvegardez les changements
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($user);
//        $entityManager->flush();
//
//        return $this->json(['message' => 'Mise à jour réussie']);
//    }


}
