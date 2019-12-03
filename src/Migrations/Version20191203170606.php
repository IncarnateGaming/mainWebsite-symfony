<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191203170606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE incarnate_item ADD type VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77ED4F3F4DFB1B2F ON incarnate_item (fid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77ED4F3FE35B9525 ON incarnate_item (ugfid)');
        $this->addSql('ALTER TABLE incarnate_background ADD type VARCHAR(255) NOT NULL, CHANGE tool_proficiencies tool_proficiencies LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE personality_fid personality_fid VARCHAR(16) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_46D3DECC4DFB1B2F ON incarnate_background (fid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_46D3DECCE35B9525 ON incarnate_background (ugfid)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_46D3DECC4DFB1B2F ON incarnate_background');
        $this->addSql('DROP INDEX UNIQ_46D3DECCE35B9525 ON incarnate_background');
        $this->addSql('ALTER TABLE incarnate_background DROP type, CHANGE tool_proficiencies tool_proficiencies VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE personality_fid personality_fid VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_77ED4F3F4DFB1B2F ON incarnate_item');
        $this->addSql('DROP INDEX UNIQ_77ED4F3FE35B9525 ON incarnate_item');
        $this->addSql('ALTER TABLE incarnate_item DROP type');
    }
}
