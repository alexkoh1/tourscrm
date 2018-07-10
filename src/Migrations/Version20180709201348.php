<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180709201348 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE client (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, tail INTEGER DEFAULT NULL, phone VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE client_tour (client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, PRIMARY KEY(client_id, tour_id))');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B19EB6921 ON client_tour (client_id)');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B15ED8D43 ON client_tour (tour_id)');
        $this->addSql('CREATE TABLE payment (id INTEGER NOT NULL, client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, sum INTEGER NOT NULL, procced_time DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D28840D19EB6921 ON payment (client_id)');
        $this->addSql('CREATE INDEX IDX_6D28840D15ED8D43 ON payment (tour_id)');
        $this->addSql('CREATE TABLE tour (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, base_cost INTEGER NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_tour');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE tour');
    }
}
