<?php

declare(strict_types=1);

namespace Formulatg\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020193024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE racing_car (racing_id INTEGER NOT NULL, car_id INTEGER NOT NULL, PRIMARY KEY(racing_id, car_id))');
        $this->addSql('CREATE INDEX IDX_189AE356A84B4D86 ON racing_car (racing_id)');
        $this->addSql('CREATE INDEX IDX_189AE356C3C6F69F ON racing_car (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE racing_car');
    }
}
