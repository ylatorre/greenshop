<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215095715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD id_avis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0C7E3D9EF FOREIGN KEY (id_avis_id) REFERENCES rep_avis (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F91ABF0C7E3D9EF ON avis (id_avis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0C7E3D9EF');
        $this->addSql('DROP INDEX UNIQ_8F91ABF0C7E3D9EF ON avis');
        $this->addSql('ALTER TABLE avis DROP id_avis_id');
    }
}
