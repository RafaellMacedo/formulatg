<?php

declare(strict_types=1);

namespace Formulatg\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211022031729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history_racing ADD COLUMN racing INTEGER NOT NULL');
        $this->addSql('ALTER TABLE history_racing ADD COLUMN carExceed INTEGER NOT NULL');
        $this->addSql('ALTER TABLE history_racing ADD COLUMN positionCarExceed VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE history_racing ADD COLUMN carOverpast INTEGER NOT NULL');
        $this->addSql('ALTER TABLE history_racing ADD COLUMN positionCarOverpast VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_189AE356C3C6F69F');
        $this->addSql('DROP INDEX IDX_189AE356A84B4D86');
        $this->addSql('CREATE TEMPORARY TABLE __temp__racing_car AS SELECT racing_id, car_id FROM racing_car');
        $this->addSql('DROP TABLE racing_car');
        $this->addSql('CREATE TABLE racing_car (racing_id INTEGER NOT NULL, car_id INTEGER NOT NULL, PRIMARY KEY(racing_id, car_id), CONSTRAINT FK_189AE356A84B4D86 FOREIGN KEY (racing_id) REFERENCES racing (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_189AE356C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO racing_car (racing_id, car_id) SELECT racing_id, car_id FROM __temp__racing_car');
        $this->addSql('DROP TABLE __temp__racing_car');
        $this->addSql('CREATE INDEX IDX_189AE356C3C6F69F ON racing_car (car_id)');
        $this->addSql('CREATE INDEX IDX_189AE356A84B4D86 ON racing_car (racing_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__history_racing AS SELECT id FROM history_racing');
        $this->addSql('DROP TABLE history_racing');
        $this->addSql('CREATE TABLE history_racing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO history_racing (id) SELECT id FROM __temp__history_racing');
        $this->addSql('DROP TABLE __temp__history_racing');
        $this->addSql('DROP INDEX IDX_189AE356A84B4D86');
        $this->addSql('DROP INDEX IDX_189AE356C3C6F69F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__racing_car AS SELECT racing_id, car_id FROM racing_car');
        $this->addSql('DROP TABLE racing_car');
        $this->addSql('CREATE TABLE racing_car (racing_id INTEGER NOT NULL, car_id INTEGER NOT NULL, PRIMARY KEY(racing_id, car_id))');
        $this->addSql('INSERT INTO racing_car (racing_id, car_id) SELECT racing_id, car_id FROM __temp__racing_car');
        $this->addSql('DROP TABLE __temp__racing_car');
        $this->addSql('CREATE INDEX IDX_189AE356A84B4D86 ON racing_car (racing_id)');
        $this->addSql('CREATE INDEX IDX_189AE356C3C6F69F ON racing_car (car_id)');
    }
}
