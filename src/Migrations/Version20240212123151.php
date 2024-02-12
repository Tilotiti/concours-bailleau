<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240212123151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contest (id INT AUTO_INCREMENT NOT NULL, year_id INT DEFAULT NULL, page_id INT DEFAULT NULL, INDEX IDX_1A95CB540C1FEA7 (year_id), INDEX IDX_1A95CB5C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contest_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_360BA3DE2C2AC5D3 (translatable_id), UNIQUE INDEX contest_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link (id INT AUTO_INCREMENT NOT NULL, year_id INT DEFAULT NULL, `index` INT NOT NULL, INDEX IDX_36AC99F140C1FEA7 (year_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_79E9C93C2C2AC5D3 (translatable_id), UNIQUE INDEX link_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_A3D51B1D2C2AC5D3 (translatable_id), UNIQUE INDEX page_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, year_id INT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, INDEX IDX_312B3E1640C1FEA7 (year_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_FD1AF3212C2AC5D3 (translatable_id), UNIQUE INDEX partner_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thank (id INT AUTO_INCREMENT NOT NULL, year_id INT DEFAULT NULL, INDEX IDX_5CE9311040C1FEA7 (year_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thank_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_50B91A682C2AC5D3 (translatable_id), UNIQUE INDEX thank_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE year (id INT NOT NULL, page_id INT DEFAULT NULL, public TINYINT(1) NOT NULL, link_sign VARCHAR(255) DEFAULT NULL, link_news VARCHAR(255) DEFAULT NULL, link_pilotes VARCHAR(255) DEFAULT NULL, link_results VARCHAR(255) DEFAULT NULL, link_download VARCHAR(255) DEFAULT NULL, link_galery VARCHAR(255) DEFAULT NULL, INDEX IDX_BB827337C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contest ADD CONSTRAINT FK_1A95CB540C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE contest ADD CONSTRAINT FK_1A95CB5C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE contest_translation ADD CONSTRAINT FK_360BA3DE2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES contest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F140C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE link_translation ADD CONSTRAINT FK_79E9C93C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_translation ADD CONSTRAINT FK_A3D51B1D2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partner ADD CONSTRAINT FK_312B3E1640C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE partner_translation ADD CONSTRAINT FK_FD1AF3212C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES partner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE thank ADD CONSTRAINT FK_5CE9311040C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE thank_translation ADD CONSTRAINT FK_50B91A682C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES thank (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE year ADD CONSTRAINT FK_BB827337C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contest_translation DROP FOREIGN KEY FK_360BA3DE2C2AC5D3');
        $this->addSql('ALTER TABLE link_translation DROP FOREIGN KEY FK_79E9C93C2C2AC5D3');
        $this->addSql('ALTER TABLE contest DROP FOREIGN KEY FK_1A95CB5C4663E4');
        $this->addSql('ALTER TABLE page_translation DROP FOREIGN KEY FK_A3D51B1D2C2AC5D3');
        $this->addSql('ALTER TABLE year DROP FOREIGN KEY FK_BB827337C4663E4');
        $this->addSql('ALTER TABLE partner_translation DROP FOREIGN KEY FK_FD1AF3212C2AC5D3');
        $this->addSql('ALTER TABLE thank_translation DROP FOREIGN KEY FK_50B91A682C2AC5D3');
        $this->addSql('ALTER TABLE contest DROP FOREIGN KEY FK_1A95CB540C1FEA7');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F140C1FEA7');
        $this->addSql('ALTER TABLE partner DROP FOREIGN KEY FK_312B3E1640C1FEA7');
        $this->addSql('ALTER TABLE thank DROP FOREIGN KEY FK_5CE9311040C1FEA7');
        $this->addSql('DROP TABLE contest');
        $this->addSql('DROP TABLE contest_translation');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE link_translation');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_translation');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE partner_translation');
        $this->addSql('DROP TABLE thank');
        $this->addSql('DROP TABLE thank_translation');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE year');
    }
}
