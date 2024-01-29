<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124160300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_produit_liste (fiche_produit_id INT NOT NULL, liste_id INT NOT NULL, INDEX IDX_9A81195EA1627A0C (fiche_produit_id), INDEX IDX_9A81195EE85441D8 (liste_id), PRIMARY KEY(fiche_produit_id, liste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_produit_categorie (fiche_produit_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_ED459AC4A1627A0C (fiche_produit_id), INDEX IDX_ED459AC4BCF5E72D (categorie_id), PRIMARY KEY(fiche_produit_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_produit_eco_score (fiche_produit_id INT NOT NULL, eco_score_id INT NOT NULL, INDEX IDX_7E3C7D8FA1627A0C (fiche_produit_id), INDEX IDX_7E3C7D8FF8DC292C (eco_score_id), PRIMARY KEY(fiche_produit_id, eco_score_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_produit_liste ADD CONSTRAINT FK_9A81195EA1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit_liste ADD CONSTRAINT FK_9A81195EE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit_categorie ADD CONSTRAINT FK_ED459AC4A1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit_categorie ADD CONSTRAINT FK_ED459AC4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit_eco_score ADD CONSTRAINT FK_7E3C7D8FA1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_produit_eco_score ADD CONSTRAINT FK_7E3C7D8FF8DC292C FOREIGN KEY (eco_score_id) REFERENCES eco_score (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_C35F0816A76ED395 ON adresse (user_id)');
        $this->addSql('ALTER TABLE avis ADD user_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL, ADD id_avis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0C7E3D9EF FOREIGN KEY (id_avis_id) REFERENCES rep_avis (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0A76ED395 ON avis (user_id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF082EA2E54 ON avis (commande_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F91ABF0C7E3D9EF ON avis (id_avis_id)');
        $this->addSql('ALTER TABLE commande ADD user_id INT DEFAULT NULL, ADD id_liste_id INT DEFAULT NULL, ADD id_etat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB88FAD4D FOREIGN KEY (id_liste_id) REFERENCES liste (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DD3C32F8F FOREIGN KEY (id_etat_id) REFERENCES etat (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DB88FAD4D ON commande (id_liste_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DD3C32F8F ON commande (id_etat_id)');
        $this->addSql('ALTER TABLE fiche_produit ADD id_etat_id INT DEFAULT NULL, ADD id_fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_produit ADD CONSTRAINT FK_31A4B7FDD3C32F8F FOREIGN KEY (id_etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE fiche_produit ADD CONSTRAINT FK_31A4B7FD5A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_31A4B7FDD3C32F8F ON fiche_produit (id_etat_id)');
        $this->addSql('CREATE INDEX IDX_31A4B7FD5A6AC879 ON fiche_produit (id_fournisseur_id)');
        $this->addSql('ALTER TABLE liste ADD quantity INT NOT NULL');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE photo ADD fiche_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418A1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id)');
        $this->addSql('CREATE INDEX IDX_14B78418A1627A0C ON photo (fiche_produit_id)');
        $this->addSql('ALTER TABLE rep_avis ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rep_avis ADD CONSTRAINT FK_4D6D0BF1A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_4D6D0BF1A76ED395 ON rep_avis (user_id)');
        $this->addSql('ALTER TABLE variante_produit ADD fiche_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE variante_produit ADD CONSTRAINT FK_7922069EA1627A0C FOREIGN KEY (fiche_produit_id) REFERENCES fiche_produit (id)');
        $this->addSql('CREATE INDEX IDX_7922069EA1627A0C ON variante_produit (fiche_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4A76ED395');
        $this->addSql('ALTER TABLE rep_avis DROP FOREIGN KEY FK_4D6D0BF1A76ED395');
        $this->addSql('ALTER TABLE fiche_produit_liste DROP FOREIGN KEY FK_9A81195EA1627A0C');
        $this->addSql('ALTER TABLE fiche_produit_liste DROP FOREIGN KEY FK_9A81195EE85441D8');
        $this->addSql('ALTER TABLE fiche_produit_categorie DROP FOREIGN KEY FK_ED459AC4A1627A0C');
        $this->addSql('ALTER TABLE fiche_produit_categorie DROP FOREIGN KEY FK_ED459AC4BCF5E72D');
        $this->addSql('ALTER TABLE fiche_produit_eco_score DROP FOREIGN KEY FK_7E3C7D8FA1627A0C');
        $this->addSql('ALTER TABLE fiche_produit_eco_score DROP FOREIGN KEY FK_7E3C7D8FF8DC292C');
        $this->addSql('DROP TABLE fiche_produit_liste');
        $this->addSql('DROP TABLE fiche_produit_categorie');
        $this->addSql('DROP TABLE fiche_produit_eco_score');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP INDEX IDX_C35F0816A76ED395 ON adresse');
        $this->addSql('ALTER TABLE adresse DROP user_id');
        $this->addSql('ALTER TABLE variante_produit DROP FOREIGN KEY FK_7922069EA1627A0C');
        $this->addSql('DROP INDEX IDX_7922069EA1627A0C ON variante_produit');
        $this->addSql('ALTER TABLE variante_produit DROP fiche_produit_id');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF082EA2E54');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0C7E3D9EF');
        $this->addSql('DROP INDEX IDX_8F91ABF0A76ED395 ON avis');
        $this->addSql('DROP INDEX IDX_8F91ABF082EA2E54 ON avis');
        $this->addSql('DROP INDEX UNIQ_8F91ABF0C7E3D9EF ON avis');
        $this->addSql('ALTER TABLE avis DROP user_id, DROP commande_id, DROP id_avis_id');
        $this->addSql('ALTER TABLE liste DROP quantity');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418A1627A0C');
        $this->addSql('DROP INDEX IDX_14B78418A1627A0C ON photo');
        $this->addSql('ALTER TABLE photo DROP fiche_produit_id');
        $this->addSql('DROP INDEX IDX_4D6D0BF1A76ED395 ON rep_avis');
        $this->addSql('ALTER TABLE rep_avis DROP user_id');
        $this->addSql('ALTER TABLE fiche_produit DROP FOREIGN KEY FK_31A4B7FDD3C32F8F');
        $this->addSql('ALTER TABLE fiche_produit DROP FOREIGN KEY FK_31A4B7FD5A6AC879');
        $this->addSql('DROP INDEX IDX_31A4B7FDD3C32F8F ON fiche_produit');
        $this->addSql('DROP INDEX IDX_31A4B7FD5A6AC879 ON fiche_produit');
        $this->addSql('ALTER TABLE fiche_produit DROP id_etat_id, DROP id_fournisseur_id');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DB88FAD4D');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DD3C32F8F');
        $this->addSql('DROP INDEX IDX_6EEAA67DA76ED395 ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DB88FAD4D ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DD3C32F8F ON commande');
        $this->addSql('ALTER TABLE commande DROP user_id, DROP id_liste_id, DROP id_etat_id');
    }
}
