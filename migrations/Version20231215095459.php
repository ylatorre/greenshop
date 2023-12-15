<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215095459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_produit_categorie (fiche_produit_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_ED459AC4A1627A0C (fiche_produit_id), INDEX IDX_ED459AC4BCF5E72D (categorie_id), PRIMARY KEY(fiche_produit_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_produit_eco_score (fiche_produit_id INT NOT NULL, eco_score_id INT NOT NULL, INDEX IDX_7E3C7D8FA1627A0C (fiche_produit_id), INDEX IDX_7E3C7D8FF8DC292C (eco_score_id), PRIMARY KEY(fiche_produit_id, eco_score_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_produit_categorie ADD CONSTRAINT FK_ED459AC4A1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit_categorie ADD CONSTRAINT FK_ED459AC4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit_eco_score ADD CONSTRAINT FK_7E3C7D8FA1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit_eco_score ADD CONSTRAINT FK_7E3C7D8FF8DC292C FOREIGN KEY (eco_score_id) REFERENCES eco_score (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit ADD id_fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_produit ADD CONSTRAINT FK_31A4B7FD5A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_31A4B7FD5A6AC879 ON fiche_produit (id_fournisseur_id)');
        $this->addSql('ALTER TABLE variante_produit ADD fiche_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE variante_produit ADD CONSTRAINT FK_7922069EA1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id)');
        $this->addSql('CREATE INDEX IDX_7922069EA1627A0C ON variante_produit (fiche_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_produit_categorie DROP FOREIGN KEY FK_ED459AC4A1627A0C');
        $this->addSql('ALTER TABLE fiche_produit_categorie DROP FOREIGN KEY FK_ED459AC4BCF5E72D');
        $this->addSql('ALTER TABLE fiche_produit_eco_score DROP FOREIGN KEY FK_7E3C7D8FA1627A0C');
        $this->addSql('ALTER TABLE fiche_produit_eco_score DROP FOREIGN KEY FK_7E3C7D8FF8DC292C');
        $this->addSql('DROP TABLE fiche_produit_categorie');
        $this->addSql('DROP TABLE fiche_produit_eco_score');
        $this->addSql('ALTER TABLE variante_produit DROP FOREIGN KEY FK_7922069EA1627A0C');
        $this->addSql('DROP INDEX IDX_7922069EA1627A0C ON variante_produit');
        $this->addSql('ALTER TABLE variante_produit DROP fiche_produit_id');
        $this->addSql('ALTER TABLE fiche_produit DROP FOREIGN KEY FK_31A4B7FD5A6AC879');
        $this->addSql('DROP INDEX IDX_31A4B7FD5A6AC879 ON fiche_produit');
        $this->addSql('ALTER TABLE fiche_produit DROP id_fournisseur_id');
    }
}
