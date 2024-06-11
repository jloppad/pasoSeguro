<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611150138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE registro ADD grupo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registro ADD CONSTRAINT FK_397CA85B9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id)');
        $this->addSql('CREATE INDEX IDX_397CA85B9C833003 ON registro (grupo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE registro DROP FOREIGN KEY FK_397CA85B9C833003');
        $this->addSql('DROP INDEX IDX_397CA85B9C833003 ON registro');
        $this->addSql('ALTER TABLE registro DROP grupo_id');
    }
}
