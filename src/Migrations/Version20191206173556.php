<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206173556 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE incarnate_item (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapter_intro (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, template TINYINT(1) DEFAULT NULL, simple_name VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, category_fid VARCHAR(16) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_background (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, featurefid VARCHAR(16) DEFAULT NULL, gp INT NOT NULL, languages LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', skill_prof LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', start_eq LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', tool_prof LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', personalityfid VARCHAR(16) NOT NULL, idealfid VARCHAR(16) NOT NULL, bondfid VARCHAR(16) NOT NULL, flawfid VARCHAR(16) NOT NULL, suggested_char_intro LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_background_feature (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, parentfid VARCHAR(16) NOT NULL, parentname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_class (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, class_ammendment LONGTEXT DEFAULT NULL, archetype LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', equipment LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', hitpoints LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', multiclass LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', proficiencies LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', leveltable LONGTEXT NOT NULL, trait LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', darkvision INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_equipment (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, gmonly TINYINT(1) NOT NULL, magical TINYINT(1) NOT NULL, mundane TINYINT(1) NOT NULL, ac LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', carryingcapacity VARCHAR(255) DEFAULT NULL, holdingcapacity VARCHAR(255) DEFAULT NULL, cost VARCHAR(255) NOT NULL, cost_sortable DOUBLE PRECISION NOT NULL, damage LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', recommendedlevel INT DEFAULT NULL, consumable TINYINT(1) DEFAULT NULL, offensebonus INT DEFAULT NULL, properties LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', itemrange VARCHAR(255) DEFAULT NULL, rarity VARCHAR(255) DEFAULT NULL, speed VARCHAR(255) DEFAULT NULL, stealth VARCHAR(255) DEFAULT NULL, strengthrequirement VARCHAR(255) DEFAULT NULL, subtype VARCHAR(255) DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, equipment_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_equipment_pack (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, includeditems LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', includedmonies LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', packtype VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_feat (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, prerequisite LONGTEXT DEFAULT NULL, recommendedclasses LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_table (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, column_names LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', dicemodifier INT DEFAULT NULL, dicetoroll VARCHAR(255) DEFAULT NULL, tr LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE incarnate_item');
        $this->addSql('DROP TABLE chapter_intro');
        $this->addSql('DROP TABLE incarnate_background');
        $this->addSql('DROP TABLE incarnate_background_feature');
        $this->addSql('DROP TABLE incarnate_class');
        $this->addSql('DROP TABLE incarnate_equipment');
        $this->addSql('DROP TABLE incarnate_equipment_pack');
        $this->addSql('DROP TABLE incarnate_feat');
        $this->addSql('DROP TABLE incarnate_table');
    }
}
