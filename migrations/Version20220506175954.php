<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506175954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_forecast DROP CONSTRAINT fk_cb649af5b9d53e94');
        $this->addSql('ALTER TABLE order_forecast DROP CONSTRAINT fk_cb649af5517fe9fe');
        $this->addSql('DROP INDEX idx_cb649af5517fe9fe');
        $this->addSql('DROP INDEX idx_cb649af5b9d53e94');
        $this->addSql('ALTER TABLE order_forecast DROP campervan_id');
        $this->addSql('ALTER TABLE order_forecast DROP equipment_id');
        $this->addSql('ALTER TABLE order_forecast DROP type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE order_forecast ADD campervan_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_forecast ADD equipment_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_forecast ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE order_forecast ADD CONSTRAINT fk_cb649af5b9d53e94 FOREIGN KEY (campervan_id) REFERENCES campervan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_forecast ADD CONSTRAINT fk_cb649af5517fe9fe FOREIGN KEY (equipment_id) REFERENCES equipment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_cb649af5517fe9fe ON order_forecast (equipment_id)');
        $this->addSql('CREATE INDEX idx_cb649af5b9d53e94 ON order_forecast (campervan_id)');
    }
}
