<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Liste;
use App\Repository\ListeRepository;
use App\Repository\CommandeRepository;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(CommandeRepository $commandeRepository,ListeRepository $listeRepository): Response
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

        return $this->render('user/compte.html.twig', [
            'user' => $user
        ]);
    }
}
