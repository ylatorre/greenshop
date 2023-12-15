<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215094906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_produit ADD id_etat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_produit ADD CONSTRAINT FK_31A4B7FDD3C32F8F FOREIGN KEY (id_etat_id) REFERENCES etat (id)');
        $this->addSql('CREATE INDEX IDX_31A4B7FDD3C32F8F ON fiche_produit (id_etat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_produit DROP FOREIGN KEY FK_31A4B7FDD3C32F8F');
        $this->addSql('DROP INDEX IDX_31A4B7FDD3C32F8F ON fiche_produit');
        $this->addSql('ALTER TABLE fiche_produit DROP id_etat_id');
    }
}
