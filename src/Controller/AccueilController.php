<?php

namespace App\Controller;

use App\Entity\Categorie;
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
        );

        $categorieRepository = $entityManager->getRepository(Categorie::class);
        $categories = $categorieRepository->findAll();


       
//je veux les imamge des produits de chaque categorie


      $filteredProduits = $entityManager->getRepository(FicheProduit::class)->findAllSortedByCategory();
      
      dd($filteredProduits);

      foreach ($filteredProduits as $filteredProduit) {
        $categories = $filteredProduit->getIdCategorie();
    
        foreach ($categories as $categorie) {
            $categorie->setImageProduit($filteredProduit->getImageProduit());
            $entityManager->persist($categorie);
        }
    
        $entityManager->flush();
    }
    
    //   dd($categories->toArray());


// Rendu de la vue
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'produitsMieuxNotes' => $produitsMieuxNotes,
            'produitsPlusVendus' => $produitsPlusVendus,
            'categories' => $categories->toArray(),


        ]);
    }

    
}
