<?php

declare(strict_types=1);

namespace Formulatg\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020022649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE racing_car (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('DROP INDEX name_driver_unique');
        $this->addSql('DROP INDEX IDX_95C71D14A84B4D86');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cars AS SELECT id, name_driver, color, number, position, status FROM cars');
        $this->addSql('DROP TABLE cars');
        $this->addSql('CREATE TABLE cars (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name_driver VARCHAR(255) NOT NULL COLLATE BINARY, color VARCHAR(255) NOT NULL COLLATE BINARY, number INTEGER NOT NULL, position INTEGER DEFAULT NULL, status INTEGER NOT NULL)');
        $this->addSql('INSERT INTO cars (id, name_driver, color, number, position, status) SELECT id, name_driver, color, number, position, status FROM __temp__cars');
        $this->addSql('DROP TABLE __temp__cars');
        $this->addSql('CREATE UNIQUE INDEX name_driver_unique ON cars (name_driver)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__racing AS SELECT id, status, name FROM racing');
        $this->addSql('DROP TABLE racing');
        $this->addSql('CREATE TABLE racing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, status INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO racing (id, status, name) SELECT id, status, name FROM __temp__racing');
        $this->addSql('DROP TABLE __temp__racing');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE racing_car');
        $this->addSql('DROP INDEX name_driver_unique');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cars AS SELECT id, name_driver, color, number, position, status FROM cars');
        $this->addSql('DROP TABLE cars');
        $this->addSql('CREATE TABLE cars (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name_driver VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, number INTEGER NOT NULL, position INTEGER DEFAULT NULL, status INTEGER NOT NULL, racing_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO cars (id, name_driver, color, number, position, status) SELECT id, name_driver, color, number, position, status FROM __temp__cars');
        $this->addSql('DROP TABLE __temp__cars');
        $this->addSql('CREATE UNIQUE INDEX name_driver_unique ON cars (name_driver)');
        $this->addSql('CREATE INDEX IDX_95C71D14A84B4D86 ON cars (racing_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__racing AS SELECT id, status, name FROM racing');
        $this->addSql('DROP TABLE racing');
        $this->addSql('CREATE TABLE racing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, status BOOLEAN NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO racing (id, status, name) SELECT id, status, name FROM __temp__racing');
        $this->addSql('DROP TABLE __temp__racing');
    }
}
