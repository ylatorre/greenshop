<?php

namespace App\Test\Controller;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/commande/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Commande::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Commande index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'commande[createdAt]' => 'Testing',
            'commande[datePreparation]' => 'Testing',
            'commande[dateExpedie]' => 'Testing',
            'commande[dateRecu]' => 'Testing',
            'commande[numeroSuivi]' => 'Testing',
            'commande[user]' => 'Testing',
            'commande[idListe]' => 'Testing',
            'commande[idEtat]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Commande();
        $fixture->setCreatedAt('My Title');
        $fixture->setDatePreparation('My Title');
        $fixture->setDateExpedie('My Title');
        $fixture->setDateRecu('My Title');
        $fixture->setNumeroSuivi('My Title');
        $fixture->setUser('My Title');
        $fixture->setIdListe('My Title');
        $fixture->setIdEtat('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Commande');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Commande();
        $fixture->setCreatedAt('Value');
        $fixture->setDatePreparation('Value');
        $fixture->setDateExpedie('Value');
        $fixture->setDateRecu('Value');
        $fixture->setNumeroSuivi('Value');
        $fixture->setUser('Value');
        $fixture->setIdListe('Value');
        $fixture->setIdEtat('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'commande[createdAt]' => 'Something New',
            'commande[datePreparation]' => 'Something New',
            'commande[dateExpedie]' => 'Something New',
            'commande[dateRecu]' => 'Something New',
            'commande[numeroSuivi]' => 'Something New',
            'commande[user]' => 'Something New',
            'commande[idListe]' => 'Something New',
            'commande[idEtat]' => 'Something New',
        ]);

        self::assertResponseRedirects('/commande/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getDatePreparation());
        self::assertSame('Something New', $fixture[0]->getDateExpedie());
        self::assertSame('Something New', $fixture[0]->getDateRecu());
        self::assertSame('Something New', $fixture[0]->getNumeroSuivi());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getIdListe());
        self::assertSame('Something New', $fixture[0]->getIdEtat());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Commande();
        $fixture->setCreatedAt('Value');
        $fixture->setDatePreparation('Value');
        $fixture->setDateExpedie('Value');
        $fixture->setDateRecu('Value');
        $fixture->setNumeroSuivi('Value');
        $fixture->setUser('Value');
        $fixture->setIdListe('Value');
        $fixture->setIdEtat('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/commande/');
        self::assertSame(0, $this->repository->count([]));
    }
}
