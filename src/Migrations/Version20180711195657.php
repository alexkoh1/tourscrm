<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180711195657 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_BB4D3A0B15ED8D43');
        $this->addSql('DROP INDEX IDX_BB4D3A0B19EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__client_tour AS SELECT client_id, tour_id FROM client_tour');
        $this->addSql('DROP TABLE client_tour');
        $this->addSql('CREATE TABLE client_tour (client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, PRIMARY KEY(client_id, tour_id), CONSTRAINT FK_BB4D3A0B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BB4D3A0B15ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO client_tour (client_id, tour_id) SELECT client_id, tour_id FROM __temp__client_tour');
        $this->addSql('DROP TABLE __temp__client_tour');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B15ED8D43 ON client_tour (tour_id)');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B19EB6921 ON client_tour (client_id)');
        $this->addSql('DROP INDEX IDX_6D28840D15ED8D43');
        $this->addSql('DROP INDEX IDX_6D28840D19EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__payment AS SELECT id, client_id, tour_id, sum, procced_time FROM payment');
        $this->addSql('DROP TABLE payment');
        $this->addSql('CREATE TABLE payment (id INTEGER NOT NULL, client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, sum INTEGER NOT NULL, procced_time DATETIME NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_6D28840D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6D28840D15ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO payment (id, client_id, tour_id, sum, procced_time) SELECT id, client_id, tour_id, sum, procced_time FROM __temp__payment');
        $this->addSql('DROP TABLE __temp__payment');
        $this->addSql('CREATE INDEX IDX_6D28840D15ED8D43 ON payment (tour_id)');
        $this->addSql('CREATE INDEX IDX_6D28840D19EB6921 ON payment (client_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__guide AS SELECT id, name, phone FROM guide');
        $this->addSql('DROP TABLE guide');
        $this->addSql('CREATE TABLE guide (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, phone VARCHAR(10) NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO guide (id, name, phone) SELECT id, name, phone FROM __temp__guide');
        $this->addSql('DROP TABLE __temp__guide');
        $this->addSql('DROP INDEX IDX_7337C20515ED8D43');
        $this->addSql('DROP INDEX IDX_7337C205D7ED1D4B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__guide_tour AS SELECT guide_id, tour_id FROM guide_tour');
        $this->addSql('DROP TABLE guide_tour');
        $this->addSql('CREATE TABLE guide_tour (guide_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, PRIMARY KEY(guide_id, tour_id), CONSTRAINT FK_7337C205D7ED1D4B FOREIGN KEY (guide_id) REFERENCES guide (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7337C20515ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO guide_tour (guide_id, tour_id) SELECT guide_id, tour_id FROM __temp__guide_tour');
        $this->addSql('DROP TABLE __temp__guide_tour');
        $this->addSql('CREATE INDEX IDX_7337C20515ED8D43 ON guide_tour (tour_id)');
        $this->addSql('CREATE INDEX IDX_7337C205D7ED1D4B ON guide_tour (guide_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_BB4D3A0B19EB6921');
        $this->addSql('DROP INDEX IDX_BB4D3A0B15ED8D43');
        $this->addSql('CREATE TEMPORARY TABLE __temp__client_tour AS SELECT client_id, tour_id FROM client_tour');
        $this->addSql('DROP TABLE client_tour');
        $this->addSql('CREATE TABLE client_tour (client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, PRIMARY KEY(client_id, tour_id))');
        $this->addSql('INSERT INTO client_tour (client_id, tour_id) SELECT client_id, tour_id FROM __temp__client_tour');
        $this->addSql('DROP TABLE __temp__client_tour');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B19EB6921 ON client_tour (client_id)');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B15ED8D43 ON client_tour (tour_id)');
        $this->addSql('ALTER TABLE guide ADD COLUMN photo BLOB NOT NULL');
        $this->addSql('DROP INDEX IDX_7337C205D7ED1D4B');
        $this->addSql('DROP INDEX IDX_7337C20515ED8D43');
        $this->addSql('CREATE TEMPORARY TABLE __temp__guide_tour AS SELECT guide_id, tour_id FROM guide_tour');
        $this->addSql('DROP TABLE guide_tour');
        $this->addSql('CREATE TABLE guide_tour (guide_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, PRIMARY KEY(guide_id, tour_id))');
        $this->addSql('INSERT INTO guide_tour (guide_id, tour_id) SELECT guide_id, tour_id FROM __temp__guide_tour');
        $this->addSql('DROP TABLE __temp__guide_tour');
        $this->addSql('CREATE INDEX IDX_7337C205D7ED1D4B ON guide_tour (guide_id)');
        $this->addSql('CREATE INDEX IDX_7337C20515ED8D43 ON guide_tour (tour_id)');
        $this->addSql('DROP INDEX IDX_6D28840D19EB6921');
        $this->addSql('DROP INDEX IDX_6D28840D15ED8D43');
        $this->addSql('CREATE TEMPORARY TABLE __temp__payment AS SELECT id, client_id, tour_id, sum, procced_time FROM payment');
        $this->addSql('DROP TABLE payment');
        $this->addSql('CREATE TABLE payment (id INTEGER NOT NULL, client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, sum INTEGER NOT NULL, procced_time DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO payment (id, client_id, tour_id, sum, procced_time) SELECT id, client_id, tour_id, sum, procced_time FROM __temp__payment');
        $this->addSql('DROP TABLE __temp__payment');
        $this->addSql('CREATE INDEX IDX_6D28840D19EB6921 ON payment (client_id)');
        $this->addSql('CREATE INDEX IDX_6D28840D15ED8D43 ON payment (tour_id)');
    }
}
