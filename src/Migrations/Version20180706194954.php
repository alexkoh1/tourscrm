<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180706194954 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE client (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, tail INTEGER DEFAULT NULL, phone VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tour (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, base_cost INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE clients_tours_cost (id INTEGER NOT NULL, client_id_id INTEGER NOT NULL, tour_id_id INTEGER NOT NULL, cost INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_711972B8DC2902E0 ON clients_tours_cost (client_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_711972B8440B8E7F ON clients_tours_cost (tour_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE tour');
        $this->addSql('DROP TABLE clients_tours_cost');
    }
}
