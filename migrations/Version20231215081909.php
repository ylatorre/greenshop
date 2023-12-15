<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215081909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4441B8B65');
        $this->addSql('DROP INDEX IDX_FCF22AF4441B8B65 ON liste');
        $this->addSql('ALTER TABLE liste DROP user2_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste ADD user2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4441B8B65 FOREIGN KEY (user2_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF4441B8B65 ON liste (user2_id)');
    }
}
