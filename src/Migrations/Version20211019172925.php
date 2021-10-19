<?php

declare(strict_types=1);

namespace Formulatg\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211019172925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cars (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, racing_id INTEGER DEFAULT NULL, name_driver VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, number INTEGER NOT NULL, position INTEGER DEFAULT NULL, status INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_95C71D14A84B4D86 ON cars (racing_id)');
        $this->addSql('CREATE UNIQUE INDEX name_driver_unique ON cars (name_driver)');
        $this->addSql('CREATE TABLE history_racing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE racing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, status BOOLEAN NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE history_racing');
        $this->addSql('DROP TABLE racing');
    }
}
