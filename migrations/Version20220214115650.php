<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214115650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tipo_iva (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kontratua_lote ADD tipo_iva_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE kontratua_lote ADD CONSTRAINT FK_A6B095CD67889002 FOREIGN KEY (tipo_iva_id) REFERENCES tipo_iva (id)');
        $this->addSql('CREATE INDEX IDX_A6B095CD67889002 ON kontratua_lote (tipo_iva_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kontratua_lote DROP FOREIGN KEY FK_A6B095CD67889002');
        $this->addSql('DROP TABLE tipo_iva');
        $this->addSql('ALTER TABLE arduraduna CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE egoera CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE fitxategi_mota CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE fitxategia CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE file_name file_name VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE kontaktuak CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE kontratista CHANGE izena_eus izena_eus VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE kontratua CHANGE espedientea espedientea VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE izena_eus izena_eus VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE izena_es izena_es VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE oharrak oharrak LONGTEXT DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE espediente_elektronikoa espediente_elektronikoa VARCHAR(12) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE artxiboa artxiboa VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('DROP INDEX IDX_A6B095CD67889002 ON kontratua_lote');
        $this->addSql('ALTER TABLE kontratua_lote DROP tipo_iva_id, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE zenbatekoaren_unitatea zenbatekoaren_unitatea VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE iraupena iraupena VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE luzapena luzapena VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE kontratua_lote_alarma CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE mota CHANGE mota_eus mota_eus VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE mota_es mota_es VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE prozedura CHANGE prozedura_eus prozedura_eus VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE prozedura_es prozedura_es VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE saila CHANGE izena izena VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE deparment deparment VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE displayname displayname VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE dn dn VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE firstname firstname VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE hizkuntza hizkuntza VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE lanpostua lanpostua VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE ldapsaila ldapsaila VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE nan nan VARCHAR(100) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE notes notes LONGTEXT DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE email email VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE surname surname VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE password password VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`');
    }
}
