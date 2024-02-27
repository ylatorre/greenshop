<?php

namespace App\Test\Controller;

use App\Entity\EcoScore;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EcoScoreControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/eco/score/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(EcoScore::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EcoScore index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'eco_score[label]' => 'Testing',
            'eco_score[score]' => 'Testing',
            'eco_score[maxScore]' => 'Testing',
            'eco_score[normes]' => 'Testing',
            'eco_score[ficheProduits]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new EcoScore();
        $fixture->setLabel('My Title');
        $fixture->setScore('My Title');
        $fixture->setMaxScore('My Title');
        $fixture->setNormes('My Title');
        $fixture->setFicheProduits('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EcoScore');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new EcoScore();
        $fixture->setLabel('Value');
        $fixture->setScore('Value');
        $fixture->setMaxScore('Value');
        $fixture->setNormes('Value');
        $fixture->setFicheProduits('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'eco_score[label]' => 'Something New',
            'eco_score[score]' => 'Something New',
            'eco_score[maxScore]' => 'Something New',
            'eco_score[normes]' => 'Something New',
            'eco_score[ficheProduits]' => 'Something New',
        ]);

        self::assertResponseRedirects('/eco/score/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getLabel());
        self::assertSame('Something New', $fixture[0]->getScore());
        self::assertSame('Something New', $fixture[0]->getMaxScore());
        self::assertSame('Something New', $fixture[0]->getNormes());
        self::assertSame('Something New', $fixture[0]->getFicheProduits());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new EcoScore();
        $fixture->setLabel('Value');
        $fixture->setScore('Value');
        $fixture->setMaxScore('Value');
        $fixture->setNormes('Value');
        $fixture->setFicheProduits('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/eco/score/');
        self::assertSame(0, $this->repository->count([]));
    }
}
