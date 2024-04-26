<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426122903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE curso_academico (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, fecha_inicio DATE NOT NULL, fecha_final DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estudiante (id INT NOT NULL, nie INT NOT NULL, foto LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo (id INT AUTO_INCREMENT NOT NULL, curso_academico_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_8C0E9BD37D35438E (curso_academico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo_usuario (grupo_id INT NOT NULL, usuario_id INT NOT NULL, INDEX IDX_7D6C3EFA9C833003 (grupo_id), INDEX IDX_7D6C3EFADB38439E (usuario_id), PRIMARY KEY(grupo_id, usuario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo_estudiante (grupo_id INT NOT NULL, estudiante_id INT NOT NULL, INDEX IDX_3BD479769C833003 (grupo_id), INDEX IDX_3BD4797659590C39 (estudiante_id), PRIMARY KEY(grupo_id, estudiante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE llave (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, hora_dejada DATETIME DEFAULT NULL, hora_devuelta DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motivo (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, numero_orden INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motivo_registro (motivo_id INT NOT NULL, registro_id INT NOT NULL, INDEX IDX_BBD27184F9E584F8 (motivo_id), INDEX IDX_BBD2718439C50FAE (registro_id), PRIMARY KEY(motivo_id, registro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE persona (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registro (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, estudiante_id INT DEFAULT NULL, llave_id INT NOT NULL, hora_salida DATETIME NOT NULL, hora_entrada DATETIME DEFAULT NULL, INDEX IDX_397CA85B53C59D72 (responsable_id), INDEX IDX_397CA85B59590C39 (estudiante_id), INDEX IDX_397CA85B8EB29E8F (llave_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT NOT NULL, username VARCHAR(255) NOT NULL, pass VARCHAR(255) NOT NULL, es_docente TINYINT(1) NOT NULL, es_conserje TINYINT(1) NOT NULL, es_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE estudiante ADD CONSTRAINT FK_3B3F3FADBF396750 FOREIGN KEY (id) REFERENCES persona (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grupo ADD CONSTRAINT FK_8C0E9BD37D35438E FOREIGN KEY (curso_academico_id) REFERENCES curso_academico (id)');
        $this->addSql('ALTER TABLE grupo_usuario ADD CONSTRAINT FK_7D6C3EFA9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grupo_usuario ADD CONSTRAINT FK_7D6C3EFADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grupo_estudiante ADD CONSTRAINT FK_3BD479769C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grupo_estudiante ADD CONSTRAINT FK_3BD4797659590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE motivo_registro ADD CONSTRAINT FK_BBD27184F9E584F8 FOREIGN KEY (motivo_id) REFERENCES motivo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE motivo_registro ADD CONSTRAINT FK_BBD2718439C50FAE FOREIGN KEY (registro_id) REFERENCES registro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registro ADD CONSTRAINT FK_397CA85B53C59D72 FOREIGN KEY (responsable_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE registro ADD CONSTRAINT FK_397CA85B59590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id)');
        $this->addSql('ALTER TABLE registro ADD CONSTRAINT FK_397CA85B8EB29E8F FOREIGN KEY (llave_id) REFERENCES llave (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DBF396750 FOREIGN KEY (id) REFERENCES persona (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE estudiante DROP FOREIGN KEY FK_3B3F3FADBF396750');
        $this->addSql('ALTER TABLE grupo DROP FOREIGN KEY FK_8C0E9BD37D35438E');
        $this->addSql('ALTER TABLE grupo_usuario DROP FOREIGN KEY FK_7D6C3EFA9C833003');
        $this->addSql('ALTER TABLE grupo_usuario DROP FOREIGN KEY FK_7D6C3EFADB38439E');
        $this->addSql('ALTER TABLE grupo_estudiante DROP FOREIGN KEY FK_3BD479769C833003');
        $this->addSql('ALTER TABLE grupo_estudiante DROP FOREIGN KEY FK_3BD4797659590C39');
        $this->addSql('ALTER TABLE motivo_registro DROP FOREIGN KEY FK_BBD27184F9E584F8');
        $this->addSql('ALTER TABLE motivo_registro DROP FOREIGN KEY FK_BBD2718439C50FAE');
        $this->addSql('ALTER TABLE registro DROP FOREIGN KEY FK_397CA85B53C59D72');
        $this->addSql('ALTER TABLE registro DROP FOREIGN KEY FK_397CA85B59590C39');
        $this->addSql('ALTER TABLE registro DROP FOREIGN KEY FK_397CA85B8EB29E8F');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05DBF396750');
        $this->addSql('DROP TABLE curso_academico');
        $this->addSql('DROP TABLE estudiante');
        $this->addSql('DROP TABLE grupo');
        $this->addSql('DROP TABLE grupo_usuario');
        $this->addSql('DROP TABLE grupo_estudiante');
        $this->addSql('DROP TABLE llave');
        $this->addSql('DROP TABLE motivo');
        $this->addSql('DROP TABLE motivo_registro');
        $this->addSql('DROP TABLE persona');
        $this->addSql('DROP TABLE registro');
        $this->addSql('DROP TABLE usuario');
    }
}
