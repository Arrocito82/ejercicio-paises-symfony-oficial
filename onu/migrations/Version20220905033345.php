<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905033345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE frontera_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE frontera (id INT NOT NULL, codigo_pais_frontera_id INT DEFAULT NULL, codigo_pais_origen_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A0CB74E1DD34AA9 ON frontera (codigo_pais_frontera_id)');
        $this->addSql('CREATE INDEX IDX_5A0CB74E7F3C8B1A ON frontera (codigo_pais_origen_id)');
        $this->addSql('CREATE TABLE pais (id INT NOT NULL, codigo INT NOT NULL, nombre VARCHAR(25) NOT NULL, capital VARCHAR(25) DEFAULT NULL, poblacion INT DEFAULT NULL, moneda VARCHAR(20) DEFAULT NULL, idioma VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE region (id INT NOT NULL, codigo INT NOT NULL, nombre VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE frontera ADD CONSTRAINT FK_5A0CB74E1DD34AA9 FOREIGN KEY (codigo_pais_frontera_id) REFERENCES pais (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE frontera ADD CONSTRAINT FK_5A0CB74E7F3C8B1A FOREIGN KEY (codigo_pais_origen_id) REFERENCES pais (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE frontera_id_seq CASCADE');
        $this->addSql('ALTER TABLE frontera DROP CONSTRAINT FK_5A0CB74E1DD34AA9');
        $this->addSql('ALTER TABLE frontera DROP CONSTRAINT FK_5A0CB74E7F3C8B1A');
        $this->addSql('DROP TABLE frontera');
        $this->addSql('DROP TABLE pais');
        $this->addSql('DROP TABLE region');
    }
}
