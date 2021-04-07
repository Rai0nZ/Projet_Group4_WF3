<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407130059 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disciplines (id INT AUTO_INCREMENT NOT NULL, matieres VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiches (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, discipline_id INT NOT NULL, fiches_prof_id_id INT NOT NULL, chapitre VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, concept_cle LONGTEXT NOT NULL, formules LONGTEXT DEFAULT NULL, a_retenir LONGTEXT NOT NULL, auteur VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_459C25C9B3E9C81 (niveau_id), INDEX IDX_459C25C9A5522701 (discipline_id), INDEX IDX_459C25C9338249A7 (fiches_prof_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveaux (id INT AUTO_INCREMENT NOT NULL, niveaux_classe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_prof (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, pseudo VARCHAR(255) NOT NULL, numen INT NOT NULL, UNIQUE INDEX UNIQ_213B3C72E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_prof_fiches (user_prof_id INT NOT NULL, fiches_id INT NOT NULL, INDEX IDX_7A9F8552F3CCE9F4 (user_prof_id), INDEX IDX_7A9F8552E9756732 (fiches_id), PRIMARY KEY(user_prof_id, fiches_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C9B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveaux (id)');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C9A5522701 FOREIGN KEY (discipline_id) REFERENCES disciplines (id)');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C9338249A7 FOREIGN KEY (fiches_prof_id_id) REFERENCES user_prof (id)');
        $this->addSql('ALTER TABLE user_prof_fiches ADD CONSTRAINT FK_7A9F8552F3CCE9F4 FOREIGN KEY (user_prof_id) REFERENCES user_prof (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_prof_fiches ADD CONSTRAINT FK_7A9F8552E9756732 FOREIGN KEY (fiches_id) REFERENCES fiches (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C9A5522701');
        $this->addSql('ALTER TABLE user_prof_fiches DROP FOREIGN KEY FK_7A9F8552E9756732');
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C9B3E9C81');
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C9338249A7');
        $this->addSql('ALTER TABLE user_prof_fiches DROP FOREIGN KEY FK_7A9F8552F3CCE9F4');
        $this->addSql('DROP TABLE disciplines');
        $this->addSql('DROP TABLE fiches');
        $this->addSql('DROP TABLE niveaux');
        $this->addSql('DROP TABLE user_prof');
        $this->addSql('DROP TABLE user_prof_fiches');
    }
}
