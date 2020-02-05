<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205000631 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE link_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE classe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE page_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contest_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE link (id INT NOT NULL, year_id INT DEFAULT NULL, index INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_36AC99F140C1FEA7 ON link (year_id)');
        $this->addSql('CREATE TABLE year (id INT NOT NULL, page_id INT DEFAULT NULL, public BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BB827337C4663E4 ON year (page_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE classe (id INT NOT NULL, contest_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F87BF961CD0F0DE ON classe (contest_id)');
        $this->addSql('CREATE TABLE page (id INT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contest (id INT NOT NULL, year_id INT DEFAULT NULL, page_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1A95CB540C1FEA7 ON contest (year_id)');
        $this->addSql('CREATE INDEX IDX_1A95CB5C4663E4 ON contest (page_id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F140C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE year ADD CONSTRAINT FK_BB827337C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF961CD0F0DE FOREIGN KEY (contest_id) REFERENCES contest (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contest ADD CONSTRAINT FK_1A95CB540C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contest ADD CONSTRAINT FK_1A95CB5C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F140C1FEA7');
        $this->addSql('ALTER TABLE contest DROP CONSTRAINT FK_1A95CB540C1FEA7');
        $this->addSql('ALTER TABLE year DROP CONSTRAINT FK_BB827337C4663E4');
        $this->addSql('ALTER TABLE contest DROP CONSTRAINT FK_1A95CB5C4663E4');
        $this->addSql('ALTER TABLE classe DROP CONSTRAINT FK_8F87BF961CD0F0DE');
        $this->addSql('DROP SEQUENCE link_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE classe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE page_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contest_id_seq CASCADE');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE year');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE contest');
    }
}
