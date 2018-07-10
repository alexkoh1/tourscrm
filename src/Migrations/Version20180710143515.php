<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180710143515 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE guide (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(10) NOT NULL, photo BLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP INDEX IDX_6D28840D15ED8D43');
        $this->addSql('DROP INDEX IDX_6D28840D19EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__payment AS SELECT id, client_id, tour_id, sum, procced_time FROM payment');
        $this->addSql('DROP TABLE payment');
        $this->addSql('CREATE TABLE payment (id INTEGER NOT NULL, client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, sum INTEGER NOT NULL, procced_time DATETIME NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_6D28840D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6D28840D15ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO payment (id, client_id, tour_id, sum, procced_time) SELECT id, client_id, tour_id, sum, procced_time FROM __temp__payment');
        $this->addSql('DROP TABLE __temp__payment');
        $this->addSql('CREATE INDEX IDX_6D28840D15ED8D43 ON payment (tour_id)');
        $this->addSql('CREATE INDEX IDX_6D28840D19EB6921 ON payment (client_id)');
        $this->addSql('DROP INDEX IDX_BB4D3A0B15ED8D43');
        $this->addSql('DROP INDEX IDX_BB4D3A0B19EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__client_tour AS SELECT client_id, tour_id FROM client_tour');
        $this->addSql('DROP TABLE client_tour');
        $this->addSql('CREATE TABLE client_tour (client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, PRIMARY KEY(client_id, tour_id), CONSTRAINT FK_BB4D3A0B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BB4D3A0B15ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO client_tour (client_id, tour_id) SELECT client_id, tour_id FROM __temp__client_tour');
        $this->addSql('DROP TABLE __temp__client_tour');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B15ED8D43 ON client_tour (tour_id)');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B19EB6921 ON client_tour (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE guide');
        $this->addSql('DROP INDEX IDX_BB4D3A0B19EB6921');
        $this->addSql('DROP INDEX IDX_BB4D3A0B15ED8D43');
        $this->addSql('CREATE TEMPORARY TABLE __temp__client_tour AS SELECT client_id, tour_id FROM client_tour');
        $this->addSql('DROP TABLE client_tour');
        $this->addSql('CREATE TABLE client_tour (client_id INTEGER NOT NULL, tour_id INTEGER NOT NULL, PRIMARY KEY(client_id, tour_id))');
        $this->addSql('INSERT INTO client_tour (client_id, tour_id) SELECT client_id, tour_id FROM __temp__client_tour');
        $this->addSql('DROP TABLE __temp__client_tour');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B19EB6921 ON client_tour (client_id)');
        $this->addSql('CREATE INDEX IDX_BB4D3A0B15ED8D43 ON client_tour (tour_id)');
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
