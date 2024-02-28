<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\FicheProduit;
use Doctrine\ORM\EntityManagerInterface;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
// Envoi de l'email
        $email = (new Email())
            ->from('yvanlatorre@outlook.fr')
            ->to('yvanlatorre@hotmail.fr')
            ->subject('Test depuis AccueilController')
            ->text('Ceci est un test d\'envoi de mail depuis AccueilController.');

//        $mailer->send($email);


$ficheProduitRepository = $entityManager->getRepository(FicheProduit::class);
        $produitsMieuxNotes = $ficheProduitRepository->findBy(
            [],
            ['noteProduit' => 'DESC'],
            8  // Limite le nombre de produits retournés
        );


        // Récupérer les 4 produits les plus vendus
        $produitsPlusVendus = $ficheProduitRepository->findBy(
            [],
            ['nombreDeVente' => 'DESC'],
            8,
              // Limite à 4 produits
        );


// Rendu de la vue
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'produitsMieuxNotes' => $produitsMieuxNotes,
            'produitsPlusVendus' => $produitsPlusVendus,


        ]);
    }

    
}
