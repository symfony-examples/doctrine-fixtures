<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417162929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create shared entity parent and children';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shared_entity_children (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, CONSTRAINT FK_EB6A92137E3C61F9 FOREIGN KEY (owner_id) REFERENCES shared_entity_parent (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EB6A92137E3C61F9 ON shared_entity_children (owner_id)');
        $this->addSql('CREATE TABLE shared_entity_parent (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE shared_entity_children');
        $this->addSql('DROP TABLE shared_entity_parent');
    }
}
