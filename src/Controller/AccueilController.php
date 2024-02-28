<?php

namespace App\Controller;


use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchTerm = $form->get('search')->getData();
            // Perform the search using $searchTerm
            // For example, you can pass it to a service or repository to fetch results

            // Replace this with your actual logic
            $results = []; // Fetch your search results

            return $this->render('produit/index.html.twig', [
                'results' => $results,
            ]);
        }

        return $this->render('accueil/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
