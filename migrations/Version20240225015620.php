<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240225015620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cat_proceso CHANGE fecha_create fecha_create DATETIME NOT NULL, CHANGE fecha_update fecha_update DATETIME NOT NULL');
        $this->addSql('ALTER TABLE cliente_proceso CHANGE fechaeje fechaeje DATE NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cat_proceso CHANGE fecha_create fecha_create DATETIME DEFAULT NULL, CHANGE fecha_update fecha_update DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE cliente_proceso CHANGE fechaeje fechaeje DATE DEFAULT NULL');
    }
}
