<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LostPassWordController extends AbstractController
{
    #[Route('/lostpassword', name: 'app_lost_pass_word')]
    public function index(): Response
    {
        return $this->render('lost_pass_word/index.html.twig', [
            'controller_name' => 'LostPassWordController',
        ]);
    }
}
