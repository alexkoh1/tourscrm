<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180706151432 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__client AS SELECT id, name, tail, phone FROM client');
        $this->addSql('DROP TABLE client');
        $this->addSql('CREATE TABLE client (id INTEGER NOT NULL, tour_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, tail INTEGER DEFAULT NULL, phone VARCHAR(10) NOT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_C744045515ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO client (id, name, tail, phone) SELECT id, name, tail, phone FROM __temp__client');
        $this->addSql('DROP TABLE __temp__client');
        $this->addSql('CREATE INDEX IDX_C744045515ED8D43 ON client (tour_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_C744045515ED8D43');
        $this->addSql('CREATE TEMPORARY TABLE __temp__client AS SELECT id, name, tail, phone FROM client');
        $this->addSql('DROP TABLE client');
        $this->addSql('CREATE TABLE client (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, tail INTEGER DEFAULT NULL, phone VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO client (id, name, tail, phone) SELECT id, name, tail, phone FROM __temp__client');
        $this->addSql('DROP TABLE __temp__client');
    }
}
