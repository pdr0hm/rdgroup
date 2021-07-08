<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701205134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE grupo_id_seq');
        $this->addSql('SELECT setval(\'grupo_id_seq\', (SELECT MAX(id) FROM grupo))');
        $this->addSql('ALTER TABLE grupo ALTER id SET DEFAULT nextval(\'grupo_id_seq\')');
        $this->addSql('CREATE SEQUENCE usuario_id_seq');
        $this->addSql('SELECT setval(\'usuario_id_seq\', (SELECT MAX(id) FROM usuario))');
        $this->addSql('ALTER TABLE usuario ALTER id SET DEFAULT nextval(\'usuario_id_seq\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE grupo ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE usuario ALTER id DROP DEFAULT');
    }
}
