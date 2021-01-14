<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218082417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenir ADD id_commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_3C914DFD9AF8E3A3 ON contenir (id_commande_id)');
        $this->addSql('ALTER TABLE magasin ADD code_postal VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD9AF8E3A3');
        $this->addSql('DROP INDEX IDX_3C914DFD9AF8E3A3 ON contenir');
        $this->addSql('ALTER TABLE contenir DROP id_commande_id');
        $this->addSql('ALTER TABLE magasin DROP code_postal');
    }
}
