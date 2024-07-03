<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703170753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE car_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE car (id INT NOT NULL, garage_id INT DEFAULT NULL, is_in_garage BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69DC4FFF555 ON car (garage_id)');
        $this->addSql('COMMENT ON COLUMN car.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DC4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE car_id_seq CASCADE');
        $this->addSql('ALTER TABLE car DROP CONSTRAINT FK_773DE69DC4FFF555');
        $this->addSql('DROP TABLE car');
    }
}
