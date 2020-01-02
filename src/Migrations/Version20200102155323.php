<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200102155323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest ADD incarnate_lore_plane_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest ADD CONSTRAINT FK_9388FACE5A2C6D79 FOREIGN KEY (incarnate_lore_plane_id) REFERENCES incarnate_lore_plane (id)');
        $this->addSql('CREATE INDEX IDX_9388FACE5A2C6D79 ON incarnate_lore_point_of_interest (incarnate_lore_plane_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest DROP FOREIGN KEY FK_9388FACE5A2C6D79');
        $this->addSql('DROP INDEX IDX_9388FACE5A2C6D79 ON incarnate_lore_point_of_interest');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest DROP incarnate_lore_plane_id');
    }
}
