<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503080725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_equipment DROP CONSTRAINT fk_6fbfae7b9eea759');
        $this->addSql('DROP INDEX idx_6fbfae7b9eea759');
        $this->addSql('ALTER TABLE order_equipment RENAME COLUMN inventory_id TO equipment_inventory_id');
        $this->addSql('ALTER TABLE order_equipment ADD CONSTRAINT FK_6FBFAE7BAC8550C6 FOREIGN KEY (equipment_inventory_id) REFERENCES inventory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6FBFAE7BAC8550C6 ON order_equipment (equipment_inventory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE order_equipment DROP CONSTRAINT FK_6FBFAE7BAC8550C6');
        $this->addSql('DROP INDEX IDX_6FBFAE7BAC8550C6');
        $this->addSql('ALTER TABLE order_equipment RENAME COLUMN equipment_inventory_id TO inventory_id');
        $this->addSql('ALTER TABLE order_equipment ADD CONSTRAINT fk_6fbfae7b9eea759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6fbfae7b9eea759 ON order_equipment (inventory_id)');
    }
}
