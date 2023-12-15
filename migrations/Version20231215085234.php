<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215085234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_produit_liste (fiche_produit_id INT NOT NULL, liste_id INT NOT NULL, INDEX IDX_9A81195EA1627A0C (fiche_produit_id), INDEX IDX_9A81195EE85441D8 (liste_id), PRIMARY KEY(fiche_produit_id, liste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_produit_liste ADD CONSTRAINT FK_9A81195EA1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit_liste ADD CONSTRAINT FK_9A81195EE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste ADD quantity INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_produit_liste DROP FOREIGN KEY FK_9A81195EA1627A0C');
        $this->addSql('ALTER TABLE fiche_produit_liste DROP FOREIGN KEY FK_9A81195EE85441D8');
        $this->addSql('DROP TABLE fiche_produit_liste');
        $this->addSql('ALTER TABLE liste DROP quantity');
    }
}
