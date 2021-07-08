<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701172951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE grupo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE usuario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE grupo_usuario (grupo_id INT NOT NULL, usuario_id INT NOT NULL, PRIMARY KEY(grupo_id, usuario_id))');
        $this->addSql('CREATE INDEX IDX_7D6C3EFA9C833003 ON grupo_usuario (grupo_id)');
        $this->addSql('CREATE INDEX IDX_7D6C3EFADB38439E ON grupo_usuario (usuario_id)');
        $this->addSql('ALTER TABLE grupo_usuario ADD CONSTRAINT FK_7D6C3EFA9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grupo_usuario ADD CONSTRAINT FK_7D6C3EFADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE grupo ALTER apresentacao TYPE TEXT');
        $this->addSql('ALTER TABLE grupo ALTER apresentacao DROP DEFAULT');
        $this->addSql('ALTER TABLE grupo ALTER visibilidade SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE grupo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE usuario_id_seq CASCADE');
        $this->addSql('DROP TABLE grupo_usuario');
        $this->addSql('ALTER TABLE grupo ALTER apresentacao TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE grupo ALTER apresentacao DROP DEFAULT');
        $this->addSql('ALTER TABLE grupo ALTER visibilidade DROP NOT NULL');
    }
}
