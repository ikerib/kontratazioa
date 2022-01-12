<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112110936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fitxategi_mota (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fitxategia (id INT AUTO_INCREMENT NOT NULL, fitxategimota_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_383EEBDC997CAD33 (fitxategimota_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kontratista (id INT AUTO_INCREMENT NOT NULL, izena_eus VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kontratua (id INT AUTO_INCREMENT NOT NULL, mota_id INT DEFAULT NULL, prozedura_id INT DEFAULT NULL, saila_id INT DEFAULT NULL, espedientea VARCHAR(255) NOT NULL, izena_eus VARCHAR(255) NOT NULL, izena_es VARCHAR(255) NOT NULL, oharrak LONGTEXT DEFAULT NULL, espediente_elektronikoa VARCHAR(12) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, artxiboa VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4143FE979867859F (mota_id), INDEX IDX_4143FE979925DFAF (prozedura_id), INDEX IDX_4143FE9739F46D1 (saila_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kontratua_lote (id INT AUTO_INCREMENT NOT NULL, kontratua_id INT DEFAULT NULL, kontratista_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, aurrekontua_iva DOUBLE PRECISION DEFAULT NULL, aurrekontua_iva_gabe DOUBLE PRECISION DEFAULT NULL, sinadura DATE DEFAULT NULL, iraupena VARCHAR(255) DEFAULT NULL, fetxa_iraupena DATE DEFAULT NULL, adjudikazioa_iva DOUBLE PRECISION DEFAULT NULL, adjudikazioa_iva_gabe DOUBLE PRECISION DEFAULT NULL, amaitua TINYINT(1) DEFAULT NULL, luzapena VARCHAR(255) DEFAULT NULL, prorroga1 DATE DEFAULT NULL, prorroga2 DATE DEFAULT NULL, prorroga3 DATE DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A6B095CDFBF7B71D (kontratua_id), INDEX IDX_A6B095CDA0ABBF35 (kontratista_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kontratua_lote_alarma (id INT AUTO_INCREMENT NOT NULL, lote_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, fetxa DATE NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_71345F99B172197C (lote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mota (id INT AUTO_INCREMENT NOT NULL, mota_eus VARCHAR(255) NOT NULL, mota_es VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, lote_id INT NOT NULL, user_id INT DEFAULT NULL, noiz DATETIME NOT NULL, notify TINYINT(1) DEFAULT NULL, emailed TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_BF5476CAB172197C (lote_id), INDEX IDX_BF5476CAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prozedura (id INT AUTO_INCREMENT NOT NULL, prozedura_eus VARCHAR(255) NOT NULL, prozedura_es VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saila (id INT AUTO_INCREMENT NOT NULL, izena VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) DEFAULT NULL, roles JSON DEFAULT NULL, deparment VARCHAR(255) DEFAULT NULL, displayname VARCHAR(255) DEFAULT NULL, dn VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, hizkuntza VARCHAR(255) DEFAULT NULL, lanpostua VARCHAR(255) DEFAULT NULL, ldapsaila VARCHAR(255) DEFAULT NULL, nan VARCHAR(100) DEFAULT NULL, notes LONGTEXT DEFAULT NULL, sailburuada TINYINT(1) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, surname VARCHAR(255) DEFAULT NULL, ldap_taldeak JSON DEFAULT NULL, ldap_rolak JSON DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fitxategia ADD CONSTRAINT FK_383EEBDC997CAD33 FOREIGN KEY (fitxategimota_id) REFERENCES fitxategi_mota (id)');
        $this->addSql('ALTER TABLE kontratua ADD CONSTRAINT FK_4143FE979867859F FOREIGN KEY (mota_id) REFERENCES mota (id)');
        $this->addSql('ALTER TABLE kontratua ADD CONSTRAINT FK_4143FE979925DFAF FOREIGN KEY (prozedura_id) REFERENCES prozedura (id)');
        $this->addSql('ALTER TABLE kontratua ADD CONSTRAINT FK_4143FE9739F46D1 FOREIGN KEY (saila_id) REFERENCES saila (id)');
        $this->addSql('ALTER TABLE kontratua_lote ADD CONSTRAINT FK_A6B095CDFBF7B71D FOREIGN KEY (kontratua_id) REFERENCES kontratua (id)');
        $this->addSql('ALTER TABLE kontratua_lote ADD CONSTRAINT FK_A6B095CDA0ABBF35 FOREIGN KEY (kontratista_id) REFERENCES kontratista (id)');
        $this->addSql('ALTER TABLE kontratua_lote_alarma ADD CONSTRAINT FK_71345F99B172197C FOREIGN KEY (lote_id) REFERENCES kontratua_lote (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAB172197C FOREIGN KEY (lote_id) REFERENCES kontratua_lote (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fitxategia DROP FOREIGN KEY FK_383EEBDC997CAD33');
        $this->addSql('ALTER TABLE kontratua_lote DROP FOREIGN KEY FK_A6B095CDA0ABBF35');
        $this->addSql('ALTER TABLE kontratua_lote DROP FOREIGN KEY FK_A6B095CDFBF7B71D');
        $this->addSql('ALTER TABLE kontratua_lote_alarma DROP FOREIGN KEY FK_71345F99B172197C');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAB172197C');
        $this->addSql('ALTER TABLE kontratua DROP FOREIGN KEY FK_4143FE979867859F');
        $this->addSql('ALTER TABLE kontratua DROP FOREIGN KEY FK_4143FE979925DFAF');
        $this->addSql('ALTER TABLE kontratua DROP FOREIGN KEY FK_4143FE9739F46D1');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAA76ED395');
        $this->addSql('DROP TABLE fitxategi_mota');
        $this->addSql('DROP TABLE fitxategia');
        $this->addSql('DROP TABLE kontratista');
        $this->addSql('DROP TABLE kontratua');
        $this->addSql('DROP TABLE kontratua_lote');
        $this->addSql('DROP TABLE kontratua_lote_alarma');
        $this->addSql('DROP TABLE mota');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE prozedura');
        $this->addSql('DROP TABLE saila');
        $this->addSql('DROP TABLE user');
    }
}
