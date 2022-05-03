<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503075704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "order" ADD campervan_inventory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F529939811E4FBBB FOREIGN KEY (campervan_inventory_id) REFERENCES inventory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F529939811E4FBBB ON "order" (campervan_inventory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F529939811E4FBBB');
        $this->addSql('DROP INDEX IDX_F529939811E4FBBB');
        $this->addSql('ALTER TABLE "order" DROP campervan_inventory_id');
        $this->addSql('ALTER TABLE "order" DROP status');
    }
}
