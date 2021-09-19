<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210916115231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kontratista (id INT AUTO_INCREMENT NOT NULL, izena_eus VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kontratua (id INT AUTO_INCREMENT NOT NULL, mota_id INT DEFAULT NULL, prozedura_id INT DEFAULT NULL, kontratista_id INT DEFAULT NULL, saila_id INT DEFAULT NULL, espedientea VARCHAR(255) NOT NULL, izena_eus VARCHAR(255) NOT NULL, izena_es VARCHAR(255) NOT NULL, aurrekontua_iva DOUBLE PRECISION DEFAULT NULL, aurrekontua_iva_gabe DOUBLE PRECISION DEFAULT NULL, sinadura DATE NOT NULL, iraupena VARCHAR(255) NOT NULL, adjudikazioa_iva DOUBLE PRECISION DEFAULT NULL, adjudikazioa_iva_gabe DOUBLE PRECISION DEFAULT NULL, amaitua TINYINT(1) NOT NULL, luzapena INT NOT NULL, oharrak LONGTEXT DEFAULT NULL, espediente_elektronikoa VARCHAR(12) DEFAULT NULL, INDEX IDX_4143FE979867859F (mota_id), INDEX IDX_4143FE979925DFAF (prozedura_id), INDEX IDX_4143FE97A0ABBF35 (kontratista_id), INDEX IDX_4143FE9739F46D1 (saila_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mota (id INT AUTO_INCREMENT NOT NULL, mota_eus VARCHAR(255) NOT NULL, mota_es VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prozedura (id INT AUTO_INCREMENT NOT NULL, prozedura_eus VARCHAR(255) NOT NULL, prozedura_es VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saila (id INT AUTO_INCREMENT NOT NULL, izena VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, deparment VARCHAR(255) DEFAULT NULL, displayname VARCHAR(255) DEFAULT NULL, dn VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, hizkuntza VARCHAR(255) DEFAULT NULL, lanpostua VARCHAR(255) DEFAULT NULL, ldapsaila VARCHAR(255) DEFAULT NULL, nan VARCHAR(100) DEFAULT NULL, notes LONGTEXT DEFAULT NULL, sailburuada TINYINT(1) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, surname VARCHAR(255) NOT NULL, ldap_taldeak JSON DEFAULT NULL, ldap_rolak JSON DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kontratua ADD CONSTRAINT FK_4143FE979867859F FOREIGN KEY (mota_id) REFERENCES mota (id)');
        $this->addSql('ALTER TABLE kontratua ADD CONSTRAINT FK_4143FE979925DFAF FOREIGN KEY (prozedura_id) REFERENCES prozedura (id)');
        $this->addSql('ALTER TABLE kontratua ADD CONSTRAINT FK_4143FE97A0ABBF35 FOREIGN KEY (kontratista_id) REFERENCES kontratista (id)');
        $this->addSql('ALTER TABLE kontratua ADD CONSTRAINT FK_4143FE9739F46D1 FOREIGN KEY (saila_id) REFERENCES saila (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kontratua DROP FOREIGN KEY FK_4143FE97A0ABBF35');
        $this->addSql('ALTER TABLE kontratua DROP FOREIGN KEY FK_4143FE979867859F');
        $this->addSql('ALTER TABLE kontratua DROP FOREIGN KEY FK_4143FE979925DFAF');
        $this->addSql('ALTER TABLE kontratua DROP FOREIGN KEY FK_4143FE9739F46D1');
        $this->addSql('DROP TABLE kontratista');
        $this->addSql('DROP TABLE kontratua');
        $this->addSql('DROP TABLE mota');
        $this->addSql('DROP TABLE prozedura');
        $this->addSql('DROP TABLE saila');
        $this->addSql('DROP TABLE user');
    }
}
