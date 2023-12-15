<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215100100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo ADD fiche_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418A1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id)');
        $this->addSql('CREATE INDEX IDX_14B78418A1627A0C ON photo (fiche_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418A1627A0C');
        $this->addSql('DROP INDEX IDX_14B78418A1627A0C ON photo');
        $this->addSql('ALTER TABLE photo DROP fiche_produit_id');
    }
}
