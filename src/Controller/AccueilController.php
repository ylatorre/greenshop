<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(MailerInterface $mailer): Response
    {
// Envoi de l'email
        $email = (new Email())
            ->from('yvanlatorre@outlook.fr')
            ->to('yvanlatorre@hotmail.fr')
            ->subject('Test depuis AccueilController')
            ->text('Ceci est un test d\'envoi de mail depuis AccueilController.');

//        $mailer->send($email);

// Rendu de la vue
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
