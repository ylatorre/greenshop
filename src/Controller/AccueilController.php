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
        $categorieNom = 'Beauté'; 
        $produitsBeaute = $entityManager->getRepository(FicheProduit::class)->findByCategorieNom($categorieNom);


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



        $ficheProduitRepository = $entityManager->getRepository(FicheProduit::class);
        $firstProductByCategory = $ficheProduitRepository->findFirstProductByCategory();

        $produits = $ficheProduitRepository->findAllSortedByCategory();
        $imagesParCategorie = [];

        foreach ($produits as $produit) {
            foreach ($produit->getIdCategorie() as $categorie) {
                if (!array_key_exists($categorie->getId(), $imagesParCategorie) && !$produit->getIdPhoto()->isEmpty()) {
                    // Supposons que getIdPhoto retourne une collection d'où vous pouvez extraire la première photo
                    $imagesParCategorie[$categorie->getId()] = $produit->getIdPhoto()->first()->getImage();
                }
            }
        }
//        dd($imagesParCategorie);
//dd($firstProductByCategory);


    //   dd($categories->toArray());


// Rendu de la vue
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'produitsMieuxNotes' => $produitsMieuxNotes,
            'produitsPlusVendus' => $produitsPlusVendus,
            'categories' => $categories,
            'firstProductByCategory' => $firstProductByCategory,
            'imagesParCategorie' => $imagesParCategorie,
            'produitsBeaute' => $produitsBeaute, // Ajoutez cette ligne



        ]);
    }

    #[Route('/AProposDeNous', name: 'app_propos')]
    public function APropos(): response
    {
        return $this->render('AProposDeNous/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/MentionLegal', name: 'app_mentions_legales')]
    public function MentionLegale(): response
    {
        return $this->render('Mention_legal/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/Nous', name: 'Nous')]
    public function Nous(): Response
    {
        return $this->render('AProposDeNous/index.html.twig', [
            
        ]);
    }
}
