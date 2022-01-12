<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112114904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fitxategia ADD kontratua_id INT DEFAULT NULL, ADD lotea_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fitxategia ADD CONSTRAINT FK_383EEBDCFBF7B71D FOREIGN KEY (kontratua_id) REFERENCES kontratua (id)');
        $this->addSql('ALTER TABLE fitxategia ADD CONSTRAINT FK_383EEBDC44636D3F FOREIGN KEY (lotea_id) REFERENCES kontratua_lote (id)');
        $this->addSql('CREATE INDEX IDX_383EEBDCFBF7B71D ON fitxategia (kontratua_id)');
        $this->addSql('CREATE INDEX IDX_383EEBDC44636D3F ON fitxategia (lotea_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fitxategia DROP FOREIGN KEY FK_383EEBDCFBF7B71D');
        $this->addSql('ALTER TABLE fitxategia DROP FOREIGN KEY FK_383EEBDC44636D3F');
        $this->addSql('DROP INDEX IDX_383EEBDCFBF7B71D ON fitxategia');
        $this->addSql('DROP INDEX IDX_383EEBDC44636D3F ON fitxategia');
        $this->addSql('ALTER TABLE fitxategia DROP kontratua_id, DROP lotea_id');
    }
}
