<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506122010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE order_forecast_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE order_forecast (id INT NOT NULL, station_id INT NOT NULL, campervan_id INT NOT NULL, equipment_id INT NOT NULL, rental_date DATE NOT NULL, expected_amount DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CB649AF521BDB235 ON order_forecast (station_id)');
        $this->addSql('CREATE INDEX IDX_CB649AF5B9D53E94 ON order_forecast (campervan_id)');
        $this->addSql('CREATE INDEX IDX_CB649AF5517FE9FE ON order_forecast (equipment_id)');
        $this->addSql('ALTER TABLE order_forecast ADD CONSTRAINT FK_CB649AF521BDB235 FOREIGN KEY (station_id) REFERENCES station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_forecast ADD CONSTRAINT FK_CB649AF5B9D53E94 FOREIGN KEY (campervan_id) REFERENCES campervan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_forecast ADD CONSTRAINT FK_CB649AF5517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE order_forecast_id_seq CASCADE');
        $this->addSql('DROP TABLE order_forecast');
    }
}
