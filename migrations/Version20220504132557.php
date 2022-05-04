<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504132557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_equipment DROP CONSTRAINT fk_6fbfae7b8d9f6d38');
        $this->addSql('DROP SEQUENCE order_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE orders (id INT NOT NULL, station_start_id INT NOT NULL, station_end_id INT DEFAULT NULL, campervan_inventory_id INT DEFAULT NULL, rental_start_date DATE NOT NULL, rental_end_date DATE NOT NULL, status VARCHAR(255) NOT NULL, context VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E52FFDEEEEA723CD ON orders (station_start_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE2D5F99F6 ON orders (station_end_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE11E4FBBB ON orders (campervan_inventory_id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEEEA723CD FOREIGN KEY (station_start_id) REFERENCES station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE2D5F99F6 FOREIGN KEY (station_end_id) REFERENCES station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE11E4FBBB FOREIGN KEY (campervan_inventory_id) REFERENCES inventory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('ALTER TABLE order_equipment ADD CONSTRAINT FK_6FBFAE7B8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_equipment DROP CONSTRAINT FK_6FBFAE7B8D9F6D38');
        $this->addSql('DROP SEQUENCE orders_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, station_start_id INT NOT NULL, station_end_id INT DEFAULT NULL, campervan_inventory_id INT DEFAULT NULL, rental_start_date DATE NOT NULL, rental_end_date DATE NOT NULL, status VARCHAR(255) NOT NULL, context VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_f5299398eea723cd ON "order" (station_start_id)');
        $this->addSql('CREATE INDEX idx_f529939811e4fbbb ON "order" (campervan_inventory_id)');
        $this->addSql('CREATE INDEX idx_f52993982d5f99f6 ON "order" (station_end_id)');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f5299398eea723cd FOREIGN KEY (station_start_id) REFERENCES station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f52993982d5f99f6 FOREIGN KEY (station_end_id) REFERENCES station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f529939811e4fbbb FOREIGN KEY (campervan_inventory_id) REFERENCES inventory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE orders');
        $this->addSql('ALTER TABLE order_equipment DROP CONSTRAINT fk_6fbfae7b8d9f6d38');
        $this->addSql('ALTER TABLE order_equipment ADD CONSTRAINT fk_6fbfae7b8d9f6d38 FOREIGN KEY (order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
