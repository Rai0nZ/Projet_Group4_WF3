<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407132728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C9338249A7');
        $this->addSql('ALTER TABLE user_prof_fiches DROP FOREIGN KEY FK_7A9F8552F3CCE9F4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, pseudo VARCHAR(255) NOT NULL, numen INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fiches (user_id INT NOT NULL, fiches_id INT NOT NULL, INDEX IDX_20CE3EF4A76ED395 (user_id), INDEX IDX_20CE3EF4E9756732 (fiches_id), PRIMARY KEY(user_id, fiches_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_fiches ADD CONSTRAINT FK_20CE3EF4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_fiches ADD CONSTRAINT FK_20CE3EF4E9756732 FOREIGN KEY (fiches_id) REFERENCES fiches (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_prof');
        $this->addSql('DROP TABLE user_prof_fiches');
        $this->addSql('DROP INDEX IDX_459C25C9338249A7 ON fiches');
        $this->addSql('ALTER TABLE fiches ADD auteur_id INT DEFAULT NULL, DROP fiches_prof_id_id, DROP auteur');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C960BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_459C25C960BB6FE6 ON fiches (auteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiches DROP FOREIGN KEY FK_459C25C960BB6FE6');
        $this->addSql('ALTER TABLE user_fiches DROP FOREIGN KEY FK_20CE3EF4A76ED395');
        $this->addSql('CREATE TABLE user_prof (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_de_naissance DATE NOT NULL, pseudo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numen INT NOT NULL, UNIQUE INDEX UNIQ_213B3C72E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_prof_fiches (user_prof_id INT NOT NULL, fiches_id INT NOT NULL, INDEX IDX_7A9F8552F3CCE9F4 (user_prof_id), INDEX IDX_7A9F8552E9756732 (fiches_id), PRIMARY KEY(user_prof_id, fiches_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_prof_fiches ADD CONSTRAINT FK_7A9F8552E9756732 FOREIGN KEY (fiches_id) REFERENCES fiches (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_prof_fiches ADD CONSTRAINT FK_7A9F8552F3CCE9F4 FOREIGN KEY (user_prof_id) REFERENCES user_prof (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_fiches');
        $this->addSql('DROP INDEX IDX_459C25C960BB6FE6 ON fiches');
        $this->addSql('ALTER TABLE fiches ADD fiches_prof_id_id INT NOT NULL, ADD auteur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP auteur_id');
        $this->addSql('ALTER TABLE fiches ADD CONSTRAINT FK_459C25C9338249A7 FOREIGN KEY (fiches_prof_id_id) REFERENCES user_prof (id)');
        $this->addSql('CREATE INDEX IDX_459C25C9338249A7 ON fiches (fiches_prof_id_id)');
    }
}
