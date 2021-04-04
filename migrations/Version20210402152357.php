<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402152357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disciplines (id INT AUTO_INCREMENT NOT NULL, matieres VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiches (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, discipline_id INT NOT NULL, chapitre VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, concept_cle LONGTEXT NOT NULL, formules LONGTEXT DEFAULT NULL, a_retenir LONGTEXT NOT NULL, INDEX IDX_459C25C9B3E9C81 (niveau_id), INDEX IDX_459C25C9A5522701 (discipline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveaux (id INT AUTO_INCREMENT NOT NULL, niveaux_classe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C9B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveaux (id)');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C9A5522701 FOREIGN KEY (discipline_id) REFERENCES disciplines (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C9A5522701');
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C9B3E9C81');
        $this->addSql('DROP TABLE disciplines');
        $this->addSql('DROP TABLE fiches');
        $this->addSql('DROP TABLE niveaux');
    }
}
