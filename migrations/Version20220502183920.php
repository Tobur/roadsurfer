<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502183920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE campervan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE inventory_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE campervan (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE equipment (id INT NOT NULL, station_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D338D58321BDB235 ON equipment (station_id)');
        $this->addSql('CREATE TABLE inventory (id INT NOT NULL, station_id INT DEFAULT NULL, campervan_id INT DEFAULT NULL, equipment_id INT DEFAULT NULL, sku VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B12D4A3621BDB235 ON inventory (station_id)');
        $this->addSql('CREATE INDEX IDX_B12D4A36B9D53E94 ON inventory (campervan_id)');
        $this->addSql('CREATE INDEX IDX_B12D4A36517FE9FE ON inventory (equipment_id)');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, station_start_id INT DEFAULT NULL, station_end_id INT DEFAULT NULL, rental_start_date DATE NOT NULL, rental_end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F5299398EEA723CD ON "order" (station_start_id)');
        $this->addSql('CREATE INDEX IDX_F52993982D5F99F6 ON "order" (station_end_id)');
        $this->addSql('CREATE TABLE order_equipment (id INT NOT NULL, inventory_id INT DEFAULT NULL, order_id INT DEFAULT NULL, amount INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6FBFAE7B9EEA759 ON order_equipment (inventory_id)');
        $this->addSql('CREATE INDEX IDX_6FBFAE7B8D9F6D38 ON order_equipment (order_id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D58321BDB235 FOREIGN KEY (station_id) REFERENCES station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A3621BDB235 FOREIGN KEY (station_id) REFERENCES station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36B9D53E94 FOREIGN KEY (campervan_id) REFERENCES campervan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398EEA723CD FOREIGN KEY (station_start_id) REFERENCES station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993982D5F99F6 FOREIGN KEY (station_end_id) REFERENCES station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_equipment ADD CONSTRAINT FK_6FBFAE7B9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_equipment ADD CONSTRAINT FK_6FBFAE7B8D9F6D38 FOREIGN KEY (order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inventory DROP CONSTRAINT FK_B12D4A36B9D53E94');
        $this->addSql('ALTER TABLE inventory DROP CONSTRAINT FK_B12D4A36517FE9FE');
        $this->addSql('ALTER TABLE order_equipment DROP CONSTRAINT FK_6FBFAE7B9EEA759');
        $this->addSql('ALTER TABLE order_equipment DROP CONSTRAINT FK_6FBFAE7B8D9F6D38');
        $this->addSql('DROP SEQUENCE campervan_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE equipment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE inventory_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE order_equipment_id_seq CASCADE');
        $this->addSql('DROP TABLE campervan');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE order_equipment');
    }
}
