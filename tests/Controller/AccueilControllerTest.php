<?php
// tests/Controller/AccueilControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccueilControllerTest extends WebTestCase
{
    public function testIndexRoute()
    {
// Crée un client pour simuler un navigateur
        $client = static::createClient();

// Exécute une requête GET sur la route de l'index
        $crawler = $client->request('GET', '/');

// Vérifie que la réponse est un succès (code 200)
        $this->assertResponseIsSuccessful();

// Vérifie que le contenu de la réponse contient un texte spécifique
// (par exemple, un texte qui est présent sur la page d'accueil)
        $this->assertSelectorTextContains('html h1', 'Accueil');
    }
}
