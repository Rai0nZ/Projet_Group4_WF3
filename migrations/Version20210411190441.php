<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411190441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disciplines (id INT AUTO_INCREMENT NOT NULL, matieres VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiches (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, discipline_id INT NOT NULL, auteur_id INT DEFAULT NULL, chapitre VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, concept_cle LONGTEXT NOT NULL, formules LONGTEXT DEFAULT NULL, a_retenir LONGTEXT NOT NULL, date DATE NOT NULL, INDEX IDX_459C25C9B3E9C81 (niveau_id), INDEX IDX_459C25C9A5522701 (discipline_id), INDEX IDX_459C25C960BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveaux (id INT AUTO_INCREMENT NOT NULL, niveaux_classe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, pseudo VARCHAR(255) NOT NULL, numen INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fiches (user_id INT NOT NULL, fiches_id INT NOT NULL, INDEX IDX_20CE3EF4A76ED395 (user_id), INDEX IDX_20CE3EF4E9756732 (fiches_id), PRIMARY KEY(user_id, fiches_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, fiche_id INT NOT NULL, UNIQUE INDEX UNIQ_5A108564FB88E14F (utilisateur_id), INDEX IDX_5A108564DF522508 (fiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C9B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveaux (id)');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C9A5522701 FOREIGN KEY (discipline_id) REFERENCES disciplines (id)');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C960BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_fiches ADD CONSTRAINT FK_20CE3EF4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_fiches ADD CONSTRAINT FK_20CE3EF4E9756732 FOREIGN KEY (fiches_id) REFERENCES fiches (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564DF522508 FOREIGN KEY (fiche_id) REFERENCES fiches (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C9A5522701');
        $this->addSql('ALTER TABLE user_fiches DROP FOREIGN KEY FK_20CE3EF4E9756732');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564DF522508');
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C9B3E9C81');
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C960BB6FE6');
        $this->addSql('ALTER TABLE user_fiches DROP FOREIGN KEY FK_20CE3EF4A76ED395');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564FB88E14F');
        $this->addSql('DROP TABLE disciplines');
        $this->addSql('DROP TABLE fiches');
        $this->addSql('DROP TABLE niveaux');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_fiches');
        $this->addSql('DROP TABLE vote');
    }
}
