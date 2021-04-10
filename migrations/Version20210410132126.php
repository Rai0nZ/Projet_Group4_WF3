<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410132126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote ADD fiches_id INT NOT NULL');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564E9756732 FOREIGN KEY (fiches_id) REFERENCES fiches (id)');
        $this->addSql('CREATE INDEX IDX_5A108564E9756732 ON vote (fiches_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564E9756732');
        $this->addSql('DROP INDEX IDX_5A108564E9756732 ON vote');
        $this->addSql('ALTER TABLE vote DROP fiches_id');
    }
}
