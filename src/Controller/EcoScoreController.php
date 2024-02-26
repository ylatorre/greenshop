<?php

namespace App\Controller;

use App\Entity\EcoScore;
use App\Form\EcoScoreType;
use App\Repository\EcoScoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/eco/score')]
class EcoScoreController extends AbstractController
{
    #[Route('/', name: 'app_eco_score_index', methods: ['GET'])]
    public function index(EcoScoreRepository $ecoScoreRepository): Response
    {
        return $this->render('eco_score/index.html.twig', [
            'eco_scores' => $ecoScoreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_eco_score_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ecoScore = new EcoScore();
        $form = $this->createForm(EcoScoreType::class, $ecoScore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ecoScore);
            $entityManager->flush();

            return $this->redirectToRoute('app_eco_score_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('eco_score/new.html.twig', [
            'eco_score' => $ecoScore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eco_score_show', methods: ['GET'])]
    public function show(EcoScore $ecoScore): Response
    {
        return $this->render('eco_score/show.html.twig', [
            'eco_score' => $ecoScore,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eco_score_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EcoScore $ecoScore, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EcoScoreType::class, $ecoScore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_eco_score_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('eco_score/edit.html.twig', [
            'eco_score' => $ecoScore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eco_score_delete', methods: ['POST'])]
    public function delete(Request $request, EcoScore $ecoScore, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ecoScore->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ecoScore);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_eco_score_index', [], Response::HTTP_SEE_OTHER);
    }
}
