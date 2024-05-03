<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503110350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario ADD user_name VARCHAR(15) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD docente TINYINT(1) NOT NULL, ADD conserje TINYINT(1) NOT NULL, ADD `admin` TINYINT(1) NOT NULL, DROP user_name, DROP password, DROP docente, DROP conserje, DROP admin');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D24A232CF ON usuario (user_name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2265B05D24A232CF ON usuario');
        $this->addSql('ALTER TABLE usuario ADD pass VARCHAR(255) NOT NULL, ADD es_docente TINYINT(1) NOT NULL, ADD es_conserje TINYINT(1) NOT NULL, ADD es_admin TINYINT(1) NOT NULL, DROP user_name, DROP docente, DROP conserje, DROP `admin`, CHANGE password username VARCHAR(255) NOT NULL');
    }
}
