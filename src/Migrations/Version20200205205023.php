<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205205023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE thank_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE link_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE classe_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE page_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contest_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partner_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE thank_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50B91A682C2AC5D3 ON thank_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX thank_translation_unique_translation ON thank_translation (translatable_id, locale)');
        $this->addSql('CREATE TABLE link_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_79E9C93C2C2AC5D3 ON link_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX link_translation_unique_translation ON link_translation (translatable_id, locale)');
        $this->addSql('CREATE TABLE classe_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_187087CE2C2AC5D3 ON classe_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX classe_translation_unique_translation ON classe_translation (translatable_id, locale)');
        $this->addSql('CREATE TABLE page_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A3D51B1D2C2AC5D3 ON page_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX page_translation_unique_translation ON page_translation (translatable_id, locale)');
        $this->addSql('CREATE TABLE contest_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_360BA3DE2C2AC5D3 ON contest_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX contest_translation_unique_translation ON contest_translation (translatable_id, locale)');
        $this->addSql('CREATE TABLE partner_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD1AF3212C2AC5D3 ON partner_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX partner_translation_unique_translation ON partner_translation (translatable_id, locale)');
        $this->addSql('ALTER TABLE thank_translation ADD CONSTRAINT FK_50B91A682C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES thank (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link_translation ADD CONSTRAINT FK_79E9C93C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES link (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE classe_translation ADD CONSTRAINT FK_187087CE2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES classe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE page_translation ADD CONSTRAINT FK_A3D51B1D2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES page (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contest_translation ADD CONSTRAINT FK_360BA3DE2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES contest (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partner_translation ADD CONSTRAINT FK_FD1AF3212C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES partner (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE thank_translation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE link_translation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE classe_translation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE page_translation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contest_translation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partner_translation_id_seq CASCADE');
        $this->addSql('DROP TABLE thank_translation');
        $this->addSql('DROP TABLE link_translation');
        $this->addSql('DROP TABLE classe_translation');
        $this->addSql('DROP TABLE page_translation');
        $this->addSql('DROP TABLE contest_translation');
        $this->addSql('DROP TABLE partner_translation');
    }
}
