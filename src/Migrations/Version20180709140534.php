<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180709140534 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE client_tour_cost (id INTEGER NOT NULL, client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, cost INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D236A4D319EB6921 ON client_tour_cost (client_id)');
        $this->addSql('CREATE INDEX IDX_D236A4D315ED8D43 ON client_tour_cost (tour_id)');
        $this->addSql('CREATE TABLE client (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, tail INTEGER DEFAULT NULL, phone VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tour (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, base_cost INTEGER NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE client_tour_cost');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE tour');
    }
}
