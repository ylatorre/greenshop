<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FicheProduit;
use App\Entity\Commande;
use App\Entity\Categorie;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;




class DashboardController extends AbstractDashboardController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $commandeRepository = $this->entityManager->getRepository(Commande::class);
$commandesParHeure = $commandeRepository->getCommandesParHeure();
$commandesParMois = $commandeRepository->getCommandesParMois();



$categorieRepository = $this->entityManager->getRepository(Categorie::class);
        $ventesParCategorie = $categorieRepository->getVentesParCategorie();



return $this->render('admin/dashboard.html.twig', [
    'commandesParMoment' => $commandesParHeure,
    'commandesParMois' => $commandesParMois,
    'ventesParCategorie' => $ventesParCategorie

    // Assurez-vous que la clé correspond à celle utilisée dans votre Twig
]);
    }







    public function configureDashboard(): Dashboard
{
    return Dashboard::new()
        ->setTitle('Greenshop')
        // Pour ajouter un logo :
        ->setFaviconPath('chemin/vers/votre/logo.ico')
        ->setTranslationDomain('votre_domaine_de_traduction')
        // Vous pouvez également personnaliser les couleurs et autres styles ici
        ;
}

public function configureMenuItems(): iterable
{
    yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
    yield MenuItem::linkToCrud('Produits', 'fa fa-tag', FicheProduit::class);
    // Ajouter d'autres entités ici
    yield MenuItem::linkToCrud('Commandes', 'fa fa-shopping-cart', Commande::class);
    yield MenuItem::linkToCrud('Catégories', 'fa fa-list', Categorie::class);

    yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
    // Ajouter des liens personnalisés
    //yield MenuItem::linkToUrl('Mon Site', 'fa fa-globe', $this->generateUrl('/'));
}

}
