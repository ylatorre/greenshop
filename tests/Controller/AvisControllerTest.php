<?php

namespace App\Test\Controller;

use App\Entity\Avis;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AvisControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/avis/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Avis::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Avi index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'avi[note]' => 'Testing',
            'avi[commentaire]' => 'Testing',
            'avi[createdAt]' => 'Testing',
            'avi[user]' => 'Testing',
            'avi[commande]' => 'Testing',
            'avi[idAvis]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Avis();
        $fixture->setNote('My Title');
        $fixture->setCommentaire('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUser('My Title');
        $fixture->setCommande('My Title');
        $fixture->setIdAvis('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Avi');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Avis();
        $fixture->setNote('Value');
        $fixture->setCommentaire('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUser('Value');
        $fixture->setCommande('Value');
        $fixture->setIdAvis('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'avi[note]' => 'Something New',
            'avi[commentaire]' => 'Something New',
            'avi[createdAt]' => 'Something New',
            'avi[user]' => 'Something New',
            'avi[commande]' => 'Something New',
            'avi[idAvis]' => 'Something New',
        ]);

        self::assertResponseRedirects('/avis/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNote());
        self::assertSame('Something New', $fixture[0]->getCommentaire());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getCommande());
        self::assertSame('Something New', $fixture[0]->getIdAvis());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Avis();
        $fixture->setNote('Value');
        $fixture->setCommentaire('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUser('Value');
        $fixture->setCommande('Value');
        $fixture->setIdAvis('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/avis/');
        self::assertSame(0, $this->repository->count([]));
    }
}
