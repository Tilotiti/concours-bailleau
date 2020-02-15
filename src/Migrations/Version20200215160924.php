<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200215160924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE thank_translation ADD content VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE thank_translation RENAME COLUMN label TO title');
        $this->addSql('ALTER TABLE thank ADD year_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE thank ADD CONSTRAINT FK_5CE9311040C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5CE9311040C1FEA7 ON thank (year_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE thank DROP CONSTRAINT FK_5CE9311040C1FEA7');
        $this->addSql('DROP INDEX IDX_5CE9311040C1FEA7');
        $this->addSql('ALTER TABLE thank DROP year_id');
        $this->addSql('ALTER TABLE thank_translation ADD label VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE thank_translation DROP title');
        $this->addSql('ALTER TABLE thank_translation DROP content');
    }
}
