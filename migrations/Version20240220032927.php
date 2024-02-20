<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220032927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cli_notas (id INT AUTO_INCREMENT NOT NULL, usu_create_id INT DEFAULT NULL, usu_update_id INT DEFAULT NULL, cliente_id INT DEFAULT NULL, nota LONGTEXT NOT NULL, fecha_create DATETIME NOT NULL, fecha_update DATETIME NOT NULL, INDEX IDX_44003BBA34063048 (usu_create_id), INDEX IDX_44003BBAF8E077A (usu_update_id), INDEX IDX_44003BBADE734E51 (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cli_notas ADD CONSTRAINT FK_44003BBA34063048 FOREIGN KEY (usu_create_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE cli_notas ADD CONSTRAINT FK_44003BBAF8E077A FOREIGN KEY (usu_update_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE cli_notas ADD CONSTRAINT FK_44003BBADE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE cliente_proceso CHANGE fechaeje fechaeje DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cli_notas DROP FOREIGN KEY FK_44003BBA34063048');
        $this->addSql('ALTER TABLE cli_notas DROP FOREIGN KEY FK_44003BBAF8E077A');
        $this->addSql('ALTER TABLE cli_notas DROP FOREIGN KEY FK_44003BBADE734E51');
        $this->addSql('DROP TABLE cli_notas');
        $this->addSql('ALTER TABLE cliente_proceso CHANGE fechaeje fechaeje DATE DEFAULT NULL');
    }
}
