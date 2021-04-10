<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410132733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote DROP INDEX UNIQ_5A108564DF522508, ADD INDEX IDX_5A108564DF522508 (fiche_id)');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564E9756732');
        $this->addSql('DROP INDEX IDX_5A108564E9756732 ON vote');
        $this->addSql('ALTER TABLE vote DROP fiches_id, CHANGE fiche_id fiche_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote DROP INDEX IDX_5A108564DF522508, ADD UNIQUE INDEX UNIQ_5A108564DF522508 (fiche_id)');
        $this->addSql('ALTER TABLE vote ADD fiches_id INT NOT NULL, CHANGE fiche_id fiche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564E9756732 FOREIGN KEY (fiches_id) REFERENCES fiches (id)');
        $this->addSql('CREATE INDEX IDX_5A108564E9756732 ON vote (fiches_id)');
    }
}
