<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523024411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pro_estados (id INT IDENTITY NOT NULL, descripcion NVARCHAR(100) NOT NULL, defecto_nuevo BIT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE pro_etiquetas (id INT IDENTITY NOT NULL, descripcion NVARCHAR(100) NOT NULL, defecto_nuevo BIT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE pro_transaccion (id INT IDENTITY NOT NULL, cliente_id INT, proceso_id INT, etiqueta_id INT, estado_id INT, usuario_id INT, proceso_nombre NVARCHAR(100) NOT NULL, fecha_inicio DATETIME2(6) NOT NULL, fecha_vence DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_699CBFAEDE734E51 ON pro_transaccion (cliente_id)');
        $this->addSql('CREATE INDEX IDX_699CBFAE640D1D53 ON pro_transaccion (proceso_id)');
        $this->addSql('CREATE INDEX IDX_699CBFAED53DA3AB ON pro_transaccion (etiqueta_id)');
        $this->addSql('CREATE INDEX IDX_699CBFAE9F5A440B ON pro_transaccion (estado_id)');
        $this->addSql('CREATE INDEX IDX_699CBFAEDB38439E ON pro_transaccion (usuario_id)');
        $this->addSql('ALTER TABLE pro_transaccion ADD CONSTRAINT FK_699CBFAEDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE pro_transaccion ADD CONSTRAINT FK_699CBFAE640D1D53 FOREIGN KEY (proceso_id) REFERENCES cat_proceso (id)');
        $this->addSql('ALTER TABLE pro_transaccion ADD CONSTRAINT FK_699CBFAED53DA3AB FOREIGN KEY (etiqueta_id) REFERENCES pro_etiquetas (id)');
        $this->addSql('ALTER TABLE pro_transaccion ADD CONSTRAINT FK_699CBFAE9F5A440B FOREIGN KEY (estado_id) REFERENCES pro_estados (id)');
        $this->addSql('ALTER TABLE pro_transaccion ADD CONSTRAINT FK_699CBFAEDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('ALTER TABLE pro_transaccion DROP CONSTRAINT FK_699CBFAEDE734E51');
        $this->addSql('ALTER TABLE pro_transaccion DROP CONSTRAINT FK_699CBFAE640D1D53');
        $this->addSql('ALTER TABLE pro_transaccion DROP CONSTRAINT FK_699CBFAED53DA3AB');
        $this->addSql('ALTER TABLE pro_transaccion DROP CONSTRAINT FK_699CBFAE9F5A440B');
        $this->addSql('ALTER TABLE pro_transaccion DROP CONSTRAINT FK_699CBFAEDB38439E');
        $this->addSql('DROP TABLE pro_estados');
        $this->addSql('DROP TABLE pro_etiquetas');
        $this->addSql('DROP TABLE pro_transaccion');
    }
}
