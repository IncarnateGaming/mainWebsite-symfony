<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191214132204 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE incarnate_item (id INT AUTO_INCREMENT NOT NULL, fid VARCHAR(16) NOT NULL, ugfid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, official VARCHAR(255) NOT NULL, legal LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, item_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapter_intro (id INT NOT NULL, template TINYINT(1) DEFAULT NULL, simple_name VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, category_fid VARCHAR(16) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_background (id INT NOT NULL, personality_id INT DEFAULT NULL, ideal_id INT DEFAULT NULL, bond_id INT DEFAULT NULL, flaw_id INT DEFAULT NULL, gp INT NOT NULL, languages LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', skill_prof LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', start_eq LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', tool_prof LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', suggested_char_intro LONGTEXT DEFAULT NULL, INDEX IDX_46D3DECCCF3DE080 (personality_id), INDEX IDX_46D3DECCC1E49882 (ideal_id), INDEX IDX_46D3DECC73A18A67 (bond_id), INDEX IDX_46D3DECCC186B37A (flaw_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_background_feature (id INT NOT NULL, incarnate_background_id INT NOT NULL, parentfid VARCHAR(16) NOT NULL, parentname VARCHAR(255) NOT NULL, INDEX IDX_FE737D13FE95C1AD (incarnate_background_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_class (id INT NOT NULL, class_ammendment LONGTEXT DEFAULT NULL, archetype LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', equipment LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', hitpoints LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', multiclass LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', proficiencies LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', leveltable LONGTEXT NOT NULL, darkvision INT DEFAULT NULL, archetype_info LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_class_archetype (id INT NOT NULL, incarnate_class_id INT NOT NULL, equipment LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', spellcasting LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_ED3FE66CB64122EC (incarnate_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_class_archetype_trait (id INT NOT NULL, incarnate_class_archetype_id INT NOT NULL, level INT NOT NULL, INDEX IDX_FAECA71F99CE8ECE (incarnate_class_archetype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_class_trait (id INT NOT NULL, incarnate_class_id INT NOT NULL, specialization_choice TINYINT(1) DEFAULT NULL, level INT NOT NULL, INDEX IDX_BE9058EAB64122EC (incarnate_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_equipment (id INT NOT NULL, gmonly TINYINT(1) NOT NULL, magical TINYINT(1) NOT NULL, mundane TINYINT(1) NOT NULL, ac LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', carryingcapacity VARCHAR(255) DEFAULT NULL, holdingcapacity VARCHAR(255) DEFAULT NULL, cost VARCHAR(255) NOT NULL, cost_sortable DOUBLE PRECISION NOT NULL, damage LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', recommendedlevel INT DEFAULT NULL, consumable TINYINT(1) DEFAULT NULL, offensebonus INT DEFAULT NULL, itemrange VARCHAR(255) DEFAULT NULL, speed VARCHAR(255) DEFAULT NULL, stealth VARCHAR(255) DEFAULT NULL, strengthrequirement VARCHAR(255) DEFAULT NULL, subtype VARCHAR(255) DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, equipment_type VARCHAR(255) NOT NULL, properties LONGTEXT DEFAULT NULL, rarity LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_equipment_pack (id INT NOT NULL, includeditems LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', includedmonies LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', packtype VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_feat (id INT NOT NULL, prerequisite LONGTEXT DEFAULT NULL, recommendedclasses LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_table (id INT NOT NULL, column_names LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', dicemodifier INT DEFAULT NULL, dicetoroll VARCHAR(255) DEFAULT NULL, tr LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chapter_intro ADD CONSTRAINT FK_9A4C539FBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_background ADD CONSTRAINT FK_46D3DECCCF3DE080 FOREIGN KEY (personality_id) REFERENCES incarnate_table (id)');
        $this->addSql('ALTER TABLE incarnate_background ADD CONSTRAINT FK_46D3DECCC1E49882 FOREIGN KEY (ideal_id) REFERENCES incarnate_table (id)');
        $this->addSql('ALTER TABLE incarnate_background ADD CONSTRAINT FK_46D3DECC73A18A67 FOREIGN KEY (bond_id) REFERENCES incarnate_table (id)');
        $this->addSql('ALTER TABLE incarnate_background ADD CONSTRAINT FK_46D3DECCC186B37A FOREIGN KEY (flaw_id) REFERENCES incarnate_table (id)');
        $this->addSql('ALTER TABLE incarnate_background ADD CONSTRAINT FK_46D3DECCBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_background_feature ADD CONSTRAINT FK_FE737D13FE95C1AD FOREIGN KEY (incarnate_background_id) REFERENCES incarnate_background (id)');
        $this->addSql('ALTER TABLE incarnate_background_feature ADD CONSTRAINT FK_FE737D13BF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_class ADD CONSTRAINT FK_A14AFFABBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_class_archetype ADD CONSTRAINT FK_ED3FE66CB64122EC FOREIGN KEY (incarnate_class_id) REFERENCES incarnate_class (id)');
        $this->addSql('ALTER TABLE incarnate_class_archetype ADD CONSTRAINT FK_ED3FE66CBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_class_archetype_trait ADD CONSTRAINT FK_FAECA71F99CE8ECE FOREIGN KEY (incarnate_class_archetype_id) REFERENCES incarnate_class_archetype (id)');
        $this->addSql('ALTER TABLE incarnate_class_archetype_trait ADD CONSTRAINT FK_FAECA71FBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_class_trait ADD CONSTRAINT FK_BE9058EAB64122EC FOREIGN KEY (incarnate_class_id) REFERENCES incarnate_class (id)');
        $this->addSql('ALTER TABLE incarnate_class_trait ADD CONSTRAINT FK_BE9058EABF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_equipment ADD CONSTRAINT FK_676F2A9DBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_equipment_pack ADD CONSTRAINT FK_45D5F3BEBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_feat ADD CONSTRAINT FK_326DFBEABF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_table ADD CONSTRAINT FK_BA286972BF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chapter_intro DROP FOREIGN KEY FK_9A4C539FBF396750');
        $this->addSql('ALTER TABLE incarnate_background DROP FOREIGN KEY FK_46D3DECCBF396750');
        $this->addSql('ALTER TABLE incarnate_background_feature DROP FOREIGN KEY FK_FE737D13BF396750');
        $this->addSql('ALTER TABLE incarnate_class DROP FOREIGN KEY FK_A14AFFABBF396750');
        $this->addSql('ALTER TABLE incarnate_class_archetype DROP FOREIGN KEY FK_ED3FE66CBF396750');
        $this->addSql('ALTER TABLE incarnate_class_archetype_trait DROP FOREIGN KEY FK_FAECA71FBF396750');
        $this->addSql('ALTER TABLE incarnate_class_trait DROP FOREIGN KEY FK_BE9058EABF396750');
        $this->addSql('ALTER TABLE incarnate_equipment DROP FOREIGN KEY FK_676F2A9DBF396750');
        $this->addSql('ALTER TABLE incarnate_equipment_pack DROP FOREIGN KEY FK_45D5F3BEBF396750');
        $this->addSql('ALTER TABLE incarnate_feat DROP FOREIGN KEY FK_326DFBEABF396750');
        $this->addSql('ALTER TABLE incarnate_table DROP FOREIGN KEY FK_BA286972BF396750');
        $this->addSql('ALTER TABLE incarnate_background_feature DROP FOREIGN KEY FK_FE737D13FE95C1AD');
        $this->addSql('ALTER TABLE incarnate_class_archetype DROP FOREIGN KEY FK_ED3FE66CB64122EC');
        $this->addSql('ALTER TABLE incarnate_class_trait DROP FOREIGN KEY FK_BE9058EAB64122EC');
        $this->addSql('ALTER TABLE incarnate_class_archetype_trait DROP FOREIGN KEY FK_FAECA71F99CE8ECE');
        $this->addSql('ALTER TABLE incarnate_background DROP FOREIGN KEY FK_46D3DECCCF3DE080');
        $this->addSql('ALTER TABLE incarnate_background DROP FOREIGN KEY FK_46D3DECCC1E49882');
        $this->addSql('ALTER TABLE incarnate_background DROP FOREIGN KEY FK_46D3DECC73A18A67');
        $this->addSql('ALTER TABLE incarnate_background DROP FOREIGN KEY FK_46D3DECCC186B37A');
        $this->addSql('DROP TABLE incarnate_item');
        $this->addSql('DROP TABLE chapter_intro');
        $this->addSql('DROP TABLE incarnate_background');
        $this->addSql('DROP TABLE incarnate_background_feature');
        $this->addSql('DROP TABLE incarnate_class');
        $this->addSql('DROP TABLE incarnate_class_archetype');
        $this->addSql('DROP TABLE incarnate_class_archetype_trait');
        $this->addSql('DROP TABLE incarnate_class_trait');
        $this->addSql('DROP TABLE incarnate_equipment');
        $this->addSql('DROP TABLE incarnate_equipment_pack');
        $this->addSql('DROP TABLE incarnate_feat');
        $this->addSql('DROP TABLE incarnate_table');
    }
}
