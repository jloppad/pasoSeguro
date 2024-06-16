<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240616104512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE llave ADD registro_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE llave ADD CONSTRAINT FK_E6B8CF5A39C50FAE FOREIGN KEY (registro_id) REFERENCES registro (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6B8CF5A39C50FAE ON llave (registro_id)');
        $this->addSql('ALTER TABLE registro DROP INDEX IDX_397CA85B8EB29E8F, ADD UNIQUE INDEX UNIQ_397CA85B8EB29E8F (llave_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE registro DROP INDEX UNIQ_397CA85B8EB29E8F, ADD INDEX IDX_397CA85B8EB29E8F (llave_id)');
        $this->addSql('ALTER TABLE llave DROP FOREIGN KEY FK_E6B8CF5A39C50FAE');
        $this->addSql('DROP INDEX UNIQ_E6B8CF5A39C50FAE ON llave');
        $this->addSql('ALTER TABLE llave DROP registro_id');
    }
}
