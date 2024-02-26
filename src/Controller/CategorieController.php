<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categorieRepository = $entityManager->getRepository(Categorie::class);
        $categories = $categorieRepository->findAll();

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'categories' => $categories
        ]);
    }

    #[Route('/categorie/{id}', name: 'categorie_show')]
public function categorie(int $id, EntityManagerInterface $entityManager): Response
{
    $categorieRepository = $entityManager->getRepository(Categorie::class);
    $categorie = $categorieRepository->find($id);

    if (!$categorie) {
        throw $this->createNotFoundException('La catégorie demandée n\'existe pas.');
    }

    $produits = $categorie->getFicheProduits();

    return $this->render('categorie/show.html.twig', [
        'categorie' => $categorie,
        'produits' => $produits,
    ]);
}

}
