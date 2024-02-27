<?php

namespace App\Test\Controller;

use App\Entity\Liste;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/liste/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Liste::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Liste index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'liste[numeroListe]' => 'Testing',
            'liste[typeListe]' => 'Testing',
            'liste[nomListe]' => 'Testing',
            'liste[quantity]' => 'Testing',
            'liste[user]' => 'Testing',
            'liste[commande]' => 'Testing',
            'liste[ficheProduits]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Liste();
        $fixture->setNumeroListe('My Title');
        $fixture->setTypeListe('My Title');
        $fixture->setNomListe('My Title');
        $fixture->setQuantity('My Title');
        $fixture->setUser('My Title');
        $fixture->setCommande('My Title');
        $fixture->setFicheProduits('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Liste');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Liste();
        $fixture->setNumeroListe('Value');
        $fixture->setTypeListe('Value');
        $fixture->setNomListe('Value');
        $fixture->setQuantity('Value');
        $fixture->setUser('Value');
        $fixture->setCommande('Value');
        $fixture->setFicheProduits('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'liste[numeroListe]' => 'Something New',
            'liste[typeListe]' => 'Something New',
            'liste[nomListe]' => 'Something New',
            'liste[quantity]' => 'Something New',
            'liste[user]' => 'Something New',
            'liste[commande]' => 'Something New',
            'liste[ficheProduits]' => 'Something New',
        ]);

        self::assertResponseRedirects('/liste/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNumeroListe());
        self::assertSame('Something New', $fixture[0]->getTypeListe());
        self::assertSame('Something New', $fixture[0]->getNomListe());
        self::assertSame('Something New', $fixture[0]->getQuantity());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getCommande());
        self::assertSame('Something New', $fixture[0]->getFicheProduits());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Liste();
        $fixture->setNumeroListe('Value');
        $fixture->setTypeListe('Value');
        $fixture->setNomListe('Value');
        $fixture->setQuantity('Value');
        $fixture->setUser('Value');
        $fixture->setCommande('Value');
        $fixture->setFicheProduits('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/liste/');
        self::assertSame(0, $this->repository->count([]));
    }
}
