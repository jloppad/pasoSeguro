<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240517111358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registro_motivo (registro_id INT NOT NULL, motivo_id INT NOT NULL, INDEX IDX_85564BCE39C50FAE (registro_id), INDEX IDX_85564BCEF9E584F8 (motivo_id), PRIMARY KEY(registro_id, motivo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE registro_motivo ADD CONSTRAINT FK_85564BCE39C50FAE FOREIGN KEY (registro_id) REFERENCES registro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registro_motivo ADD CONSTRAINT FK_85564BCEF9E584F8 FOREIGN KEY (motivo_id) REFERENCES motivo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE motivo_registro DROP FOREIGN KEY FK_BBD2718439C50FAE');
        $this->addSql('ALTER TABLE motivo_registro DROP FOREIGN KEY FK_BBD27184F9E584F8');
        $this->addSql('DROP TABLE motivo_registro');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE motivo_registro (motivo_id INT NOT NULL, registro_id INT NOT NULL, INDEX IDX_BBD2718439C50FAE (registro_id), INDEX IDX_BBD27184F9E584F8 (motivo_id), PRIMARY KEY(motivo_id, registro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE motivo_registro ADD CONSTRAINT FK_BBD2718439C50FAE FOREIGN KEY (registro_id) REFERENCES registro (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE motivo_registro ADD CONSTRAINT FK_BBD27184F9E584F8 FOREIGN KEY (motivo_id) REFERENCES motivo (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registro_motivo DROP FOREIGN KEY FK_85564BCE39C50FAE');
        $this->addSql('ALTER TABLE registro_motivo DROP FOREIGN KEY FK_85564BCEF9E584F8');
        $this->addSql('DROP TABLE registro_motivo');
    }
}
