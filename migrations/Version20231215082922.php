<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215082922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF082EA2E54 ON avis (commande_id)');
        $this->addSql('ALTER TABLE commande ADD id_liste_id INT DEFAULT NULL, ADD id_etat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB88FAD4D FOREIGN KEY (id_liste_id) REFERENCES liste (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DD3C32F8F FOREIGN KEY (id_etat_id) REFERENCES etat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DB88FAD4D ON commande (id_liste_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DD3C32F8F ON commande (id_etat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DB88FAD4D');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DD3C32F8F');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DB88FAD4D ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DD3C32F8F ON commande');
        $this->addSql('ALTER TABLE commande DROP id_liste_id, DROP id_etat_id');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF082EA2E54');
        $this->addSql('DROP INDEX IDX_8F91ABF082EA2E54 ON avis');
        $this->addSql('ALTER TABLE avis DROP commande_id');
    }
}
