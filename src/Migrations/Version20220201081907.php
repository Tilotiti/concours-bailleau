<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201081907 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE year ADD link_sign VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE year ADD link_news VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE year ADD link_pilotes VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE year ADD link_results VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE year ADD link_download VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE year ADD link_galery VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE year DROP link_sign');
        $this->addSql('ALTER TABLE year DROP link_news');
        $this->addSql('ALTER TABLE year DROP link_pilotes');
        $this->addSql('ALTER TABLE year DROP link_results');
        $this->addSql('ALTER TABLE year DROP link_download');
        $this->addSql('ALTER TABLE year DROP link_galery');
    }
}
