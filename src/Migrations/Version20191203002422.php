<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191203002422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE incarnate_background (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, feature_fid VARCHAR(255) NOT NULL, gp INT NOT NULL, languages LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', skill_proficiencies VARCHAR(255) NOT NULL, starting_equipment LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', tool_proficiencies VARCHAR(255) DEFAULT NULL, personality_fid VARCHAR(255) NOT NULL, ideal_fid VARCHAR(16) NOT NULL, bond_fid VARCHAR(16) NOT NULL, flaw_fid VARCHAR(16) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE incarnate_background');
    }
}
