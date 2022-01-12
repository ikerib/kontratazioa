<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112105111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE erabiltzailea');
        $this->addSql('ALTER TABLE kontratista ADD created_at DATETIME NULL, ADD updated_at DATETIME  NULL');
        $this->addSql('ALTER TABLE kontratua ADD created_at DATETIME NULL, ADD updated_at DATETIME  NULL');
        $this->addSql('ALTER TABLE kontratua_lote ADD created_at DATETIME NULL, ADD updated_at DATETIME  NULL');
        $this->addSql('ALTER TABLE mota ADD created_at DATETIME  NULL, ADD updated_at DATETIME  NULL');
        $this->addSql('ALTER TABLE notification ADD created_at DATETIME  NULL, ADD updated_at DATETIME  NULL');
        $this->addSql('ALTER TABLE prozedura ADD created_at DATETIME  NULL, ADD updated_at DATETIME  NULL');
        $this->addSql('ALTER TABLE saila ADD created_at DATETIME  NULL, ADD updated_at DATETIME  NULL');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME  NULL, ADD updated_at DATETIME  NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE erabiltzailea (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, roles JSON NOT NULL, deparment VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, displayname VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, dn VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, enabled TINYINT(1) DEFAULT NULL, firstname VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, hizkuntza VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, lanpostua VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ldapsaila VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, nan VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, notes LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, sailburuada TINYINT(1) DEFAULT NULL, email VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, surname VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ldap_taldeak JSON DEFAULT NULL, ldap_rolak JSON DEFAULT NULL, password VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, UNIQUE INDEX UNIQ_D405EF99F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE kontratista DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE kontratua DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE kontratua_lote DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE mota DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE notification DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE prozedura DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE saila DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE user DROP created_at, DROP updated_at');
    }
}
