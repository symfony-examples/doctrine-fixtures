<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417171619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Multi referenced entities : parent and children';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE multi_reference_entity_children (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE multi_reference_entity_children_multi_reference_entity_parent (multi_reference_entity_children_id INTEGER NOT NULL, multi_reference_entity_parent_id INTEGER NOT NULL, PRIMARY KEY(multi_reference_entity_children_id, multi_reference_entity_parent_id), CONSTRAINT FK_AF873BA6C8D9644C FOREIGN KEY (multi_reference_entity_children_id) REFERENCES multi_reference_entity_children (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AF873BA6FB1EA2B5 FOREIGN KEY (multi_reference_entity_parent_id) REFERENCES multi_reference_entity_parent (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_AF873BA6C8D9644C ON multi_reference_entity_children_multi_reference_entity_parent (multi_reference_entity_children_id)');
        $this->addSql('CREATE INDEX IDX_AF873BA6FB1EA2B5 ON multi_reference_entity_children_multi_reference_entity_parent (multi_reference_entity_parent_id)');
        $this->addSql('CREATE TABLE multi_reference_entity_parent (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE multi_reference_entity_children');
        $this->addSql('DROP TABLE multi_reference_entity_children_multi_reference_entity_parent');
        $this->addSql('DROP TABLE multi_reference_entity_parent');
    }
}
