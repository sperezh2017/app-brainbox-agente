<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207140841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cat_sub_procesos ADD usu_create_id INT DEFAULT NULL, ADD usu_update_id INT DEFAULT NULL, ADD fecha_create DATETIME NULL, ADD fecha_update DATETIME NULL');
        $this->addSql('ALTER TABLE cat_sub_procesos ADD CONSTRAINT FK_FF27A33834063048 FOREIGN KEY (usu_create_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE cat_sub_procesos ADD CONSTRAINT FK_FF27A338F8E077A FOREIGN KEY (usu_update_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_FF27A33834063048 ON cat_sub_procesos (usu_create_id)');
        $this->addSql('CREATE INDEX IDX_FF27A338F8E077A ON cat_sub_procesos (usu_update_id)');
        $this->addSql('ALTER TABLE cliente_proceso CHANGE fechaeje fechaeje DATE NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE cat_sub_procesos DROP FOREIGN KEY FK_FF27A33834063048');
        $this->addSql('ALTER TABLE cat_sub_procesos DROP FOREIGN KEY FK_FF27A338F8E077A');
        $this->addSql('DROP INDEX IDX_FF27A33834063048 ON cat_sub_procesos');
        $this->addSql('DROP INDEX IDX_FF27A338F8E077A ON cat_sub_procesos');
        $this->addSql('ALTER TABLE cat_sub_procesos DROP usu_create_id, DROP usu_update_id, DROP fecha_create, DROP fecha_update');
        $this->addSql('ALTER TABLE cliente_proceso CHANGE fechaeje fechaeje DATE DEFAULT NULL');
    }
}
