<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112202217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE erabiltzailea (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, deparment VARCHAR(255) DEFAULT NULL, displayname VARCHAR(255) DEFAULT NULL, dn VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, hizkuntza VARCHAR(255) DEFAULT NULL, lanpostua VARCHAR(255) DEFAULT NULL, ldapsaila VARCHAR(255) DEFAULT NULL, nan VARCHAR(100) DEFAULT NULL, notes LONGTEXT DEFAULT NULL, sailburuada TINYINT(1) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, surname VARCHAR(255) NOT NULL, ldap_taldeak JSON DEFAULT NULL, ldap_rolak JSON DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D405EF99F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, erabiltzailea_id INT NOT NULL, INDEX IDX_BF5476CA3D0F5D37 (erabiltzailea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA3D0F5D37 FOREIGN KEY (erabiltzailea_id) REFERENCES erabiltzailea (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA3D0F5D37');
        $this->addSql('DROP TABLE erabiltzailea');
        $this->addSql('DROP TABLE notification');
    }
}
