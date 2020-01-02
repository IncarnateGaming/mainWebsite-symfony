<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200102144305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE incarnate_lore_buildings (id INT NOT NULL, incarnate_lore_district_id INT NOT NULL, map VARCHAR(255) DEFAULT NULL, INDEX IDX_6B2A4EEE2252DD6B (incarnate_lore_district_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_lore_citizen (id INT NOT NULL, background_id INT NOT NULL, race_id INT NOT NULL, subrace_id INT DEFAULT NULL, incarnate_lore_subpoint_id INT DEFAULT NULL, incarnate_lore_building_id INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, ability_scores LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ac LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ac_total INT NOT NULL, classes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', experience LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', feat_list LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', hp LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', initiative LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', initiative_total INT NOT NULL, inventory LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', languages LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', age INT DEFAULT NULL, personality LONGTEXT DEFAULT NULL, ideal LONGTEXT DEFAULT NULL, bond LONGTEXT DEFAULT NULL, flaw LONGTEXT DEFAULT NULL, skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', spellcasting LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', level INT NOT NULL, INDEX IDX_B9438A80C93D69EA (background_id), INDEX IDX_B9438A806E59D40D (race_id), INDEX IDX_B9438A80253B7CC2 (subrace_id), INDEX IDX_B9438A8059650C32 (incarnate_lore_subpoint_id), INDEX IDX_B9438A80DFF7010B (incarnate_lore_building_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_lore_city (id INT NOT NULL, incarnate_lore_state_id INT NOT NULL, map VARCHAR(255) DEFAULT NULL, INDEX IDX_7450F1CEAAC23710 (incarnate_lore_state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_lore_country (id INT NOT NULL, incarnate_lore_planet_id INT NOT NULL, map VARCHAR(255) DEFAULT NULL, INDEX IDX_436354CF53256069 (incarnate_lore_planet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_lore_district (id INT NOT NULL, incarnate_lore_city_id INT NOT NULL, map VARCHAR(255) DEFAULT NULL, INDEX IDX_9EDB5F569BBCFF06 (incarnate_lore_city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_lore_plane (id INT NOT NULL, map VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_lore_planet (id INT NOT NULL, incarnate_lore_plane_id INT NOT NULL, map VARCHAR(255) DEFAULT NULL, INDEX IDX_A2F4993F5A2C6D79 (incarnate_lore_plane_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_lore_point_of_interest (id INT NOT NULL, incarnate_lore_planet_id INT DEFAULT NULL, incarnate_lore_country_id INT DEFAULT NULL, incarnate_lore_state_id INT DEFAULT NULL, incarnate_lore_city_id INT DEFAULT NULL, incarnate_lore_district_id INT DEFAULT NULL, incarnate_lore_buildings_id INT DEFAULT NULL, map VARCHAR(255) DEFAULT NULL, INDEX IDX_9388FACE53256069 (incarnate_lore_planet_id), INDEX IDX_9388FACEF6DEBCBC (incarnate_lore_country_id), INDEX IDX_9388FACEAAC23710 (incarnate_lore_state_id), INDEX IDX_9388FACE9BBCFF06 (incarnate_lore_city_id), INDEX IDX_9388FACE2252DD6B (incarnate_lore_district_id), INDEX IDX_9388FACE707C93AC (incarnate_lore_buildings_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_lore_state (id INT NOT NULL, incarnate_lore_country_id INT DEFAULT NULL, map VARCHAR(255) DEFAULT NULL, INDEX IDX_FEA2C20AF6DEBCBC (incarnate_lore_country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incarnate_lore_subpoint (id INT NOT NULL, incarnate_lore_point_of_interest_id INT NOT NULL, map VARCHAR(255) DEFAULT NULL, INDEX IDX_620C172FF0407CCC (incarnate_lore_point_of_interest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incarnate_lore_buildings ADD CONSTRAINT FK_6B2A4EEE2252DD6B FOREIGN KEY (incarnate_lore_district_id) REFERENCES incarnate_lore_district (id)');
        $this->addSql('ALTER TABLE incarnate_lore_buildings ADD CONSTRAINT FK_6B2A4EEEBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_lore_citizen ADD CONSTRAINT FK_B9438A80C93D69EA FOREIGN KEY (background_id) REFERENCES incarnate_background (id)');
        $this->addSql('ALTER TABLE incarnate_lore_citizen ADD CONSTRAINT FK_B9438A806E59D40D FOREIGN KEY (race_id) REFERENCES incarnate_race (id)');
        $this->addSql('ALTER TABLE incarnate_lore_citizen ADD CONSTRAINT FK_B9438A80253B7CC2 FOREIGN KEY (subrace_id) REFERENCES incarnate_race_subrace (id)');
        $this->addSql('ALTER TABLE incarnate_lore_citizen ADD CONSTRAINT FK_B9438A8059650C32 FOREIGN KEY (incarnate_lore_subpoint_id) REFERENCES incarnate_lore_subpoint (id)');
        $this->addSql('ALTER TABLE incarnate_lore_citizen ADD CONSTRAINT FK_B9438A80DFF7010B FOREIGN KEY (incarnate_lore_building_id) REFERENCES incarnate_lore_buildings (id)');
        $this->addSql('ALTER TABLE incarnate_lore_citizen ADD CONSTRAINT FK_B9438A80BF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_lore_city ADD CONSTRAINT FK_7450F1CEAAC23710 FOREIGN KEY (incarnate_lore_state_id) REFERENCES incarnate_lore_state (id)');
        $this->addSql('ALTER TABLE incarnate_lore_city ADD CONSTRAINT FK_7450F1CEBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_lore_country ADD CONSTRAINT FK_436354CF53256069 FOREIGN KEY (incarnate_lore_planet_id) REFERENCES incarnate_lore_planet (id)');
        $this->addSql('ALTER TABLE incarnate_lore_country ADD CONSTRAINT FK_436354CFBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_lore_district ADD CONSTRAINT FK_9EDB5F569BBCFF06 FOREIGN KEY (incarnate_lore_city_id) REFERENCES incarnate_lore_city (id)');
        $this->addSql('ALTER TABLE incarnate_lore_district ADD CONSTRAINT FK_9EDB5F56BF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_lore_plane ADD CONSTRAINT FK_9C823D71BF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_lore_planet ADD CONSTRAINT FK_A2F4993F5A2C6D79 FOREIGN KEY (incarnate_lore_plane_id) REFERENCES incarnate_lore_plane (id)');
        $this->addSql('ALTER TABLE incarnate_lore_planet ADD CONSTRAINT FK_A2F4993FBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest ADD CONSTRAINT FK_9388FACE53256069 FOREIGN KEY (incarnate_lore_planet_id) REFERENCES incarnate_lore_planet (id)');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest ADD CONSTRAINT FK_9388FACEF6DEBCBC FOREIGN KEY (incarnate_lore_country_id) REFERENCES incarnate_lore_country (id)');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest ADD CONSTRAINT FK_9388FACEAAC23710 FOREIGN KEY (incarnate_lore_state_id) REFERENCES incarnate_lore_state (id)');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest ADD CONSTRAINT FK_9388FACE9BBCFF06 FOREIGN KEY (incarnate_lore_city_id) REFERENCES incarnate_lore_city (id)');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest ADD CONSTRAINT FK_9388FACE2252DD6B FOREIGN KEY (incarnate_lore_district_id) REFERENCES incarnate_lore_district (id)');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest ADD CONSTRAINT FK_9388FACE707C93AC FOREIGN KEY (incarnate_lore_buildings_id) REFERENCES incarnate_lore_buildings (id)');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest ADD CONSTRAINT FK_9388FACEBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_lore_state ADD CONSTRAINT FK_FEA2C20AF6DEBCBC FOREIGN KEY (incarnate_lore_country_id) REFERENCES incarnate_lore_country (id)');
        $this->addSql('ALTER TABLE incarnate_lore_state ADD CONSTRAINT FK_FEA2C20ABF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnate_lore_subpoint ADD CONSTRAINT FK_620C172FF0407CCC FOREIGN KEY (incarnate_lore_point_of_interest_id) REFERENCES incarnate_lore_point_of_interest (id)');
        $this->addSql('ALTER TABLE incarnate_lore_subpoint ADD CONSTRAINT FK_620C172FBF396750 FOREIGN KEY (id) REFERENCES incarnate_item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE incarnate_lore_citizen DROP FOREIGN KEY FK_B9438A80DFF7010B');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest DROP FOREIGN KEY FK_9388FACE707C93AC');
        $this->addSql('ALTER TABLE incarnate_lore_district DROP FOREIGN KEY FK_9EDB5F569BBCFF06');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest DROP FOREIGN KEY FK_9388FACE9BBCFF06');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest DROP FOREIGN KEY FK_9388FACEF6DEBCBC');
        $this->addSql('ALTER TABLE incarnate_lore_state DROP FOREIGN KEY FK_FEA2C20AF6DEBCBC');
        $this->addSql('ALTER TABLE incarnate_lore_buildings DROP FOREIGN KEY FK_6B2A4EEE2252DD6B');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest DROP FOREIGN KEY FK_9388FACE2252DD6B');
        $this->addSql('ALTER TABLE incarnate_lore_planet DROP FOREIGN KEY FK_A2F4993F5A2C6D79');
        $this->addSql('ALTER TABLE incarnate_lore_country DROP FOREIGN KEY FK_436354CF53256069');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest DROP FOREIGN KEY FK_9388FACE53256069');
        $this->addSql('ALTER TABLE incarnate_lore_subpoint DROP FOREIGN KEY FK_620C172FF0407CCC');
        $this->addSql('ALTER TABLE incarnate_lore_city DROP FOREIGN KEY FK_7450F1CEAAC23710');
        $this->addSql('ALTER TABLE incarnate_lore_point_of_interest DROP FOREIGN KEY FK_9388FACEAAC23710');
        $this->addSql('ALTER TABLE incarnate_lore_citizen DROP FOREIGN KEY FK_B9438A8059650C32');
        $this->addSql('DROP TABLE incarnate_lore_buildings');
        $this->addSql('DROP TABLE incarnate_lore_citizen');
        $this->addSql('DROP TABLE incarnate_lore_city');
        $this->addSql('DROP TABLE incarnate_lore_country');
        $this->addSql('DROP TABLE incarnate_lore_district');
        $this->addSql('DROP TABLE incarnate_lore_plane');
        $this->addSql('DROP TABLE incarnate_lore_planet');
        $this->addSql('DROP TABLE incarnate_lore_point_of_interest');
        $this->addSql('DROP TABLE incarnate_lore_state');
        $this->addSql('DROP TABLE incarnate_lore_subpoint');
    }
}
