<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220906203723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pais ADD region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pais ADD CONSTRAINT FK_7E5D2EFF98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7E5D2EFF98260155 ON pais (region_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pais DROP CONSTRAINT FK_7E5D2EFF98260155');
        $this->addSql('DROP INDEX IDX_7E5D2EFF98260155');
        $this->addSql('ALTER TABLE pais DROP region_id');
    }
}
