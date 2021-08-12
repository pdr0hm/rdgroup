<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210806172756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE grupo (id SERIAL NOT NULL, nome_grupo VARCHAR(100) NOT NULL, apresentacao TEXT NOT NULL, visibilidade BOOLEAN NOT NULL, foto_capa VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE grupo_usuario (grupo_id INT NOT NULL, usuario_id INT NOT NULL, PRIMARY KEY(grupo_id, usuario_id))');
        $this->addSql('CREATE INDEX IDX_7D6C3EFA9C833003 ON grupo_usuario (grupo_id)');
        $this->addSql('CREATE INDEX IDX_7D6C3EFADB38439E ON grupo_usuario (usuario_id)');
        $this->addSql('CREATE TABLE usuario (id SERIAL NOT NULL, nome VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D35C246D5 ON usuario (password)');
        $this->addSql('ALTER TABLE grupo_usuario ADD CONSTRAINT FK_7D6C3EFA9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grupo_usuario ADD CONSTRAINT FK_7D6C3EFADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE grupo_usuario DROP CONSTRAINT FK_7D6C3EFA9C833003');
        $this->addSql('ALTER TABLE grupo_usuario DROP CONSTRAINT FK_7D6C3EFADB38439E');
        $this->addSql('DROP TABLE grupo');
        $this->addSql('DROP TABLE grupo_usuario');
        $this->addSql('DROP TABLE usuario');
    }
}
