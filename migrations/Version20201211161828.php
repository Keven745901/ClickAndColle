<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201211161828 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD id_type_article_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6686C99331 FOREIGN KEY (id_type_article_id) REFERENCES type_article (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6686C99331 ON article (id_type_article_id)');
        $this->addSql('ALTER TABLE stock ADD id_magasin_id INT NOT NULL, ADD id_article_id INT NOT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656608583EA34 FOREIGN KEY (id_magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660D71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_4B3656608583EA34 ON stock (id_magasin_id)');
        $this->addSql('CREATE INDEX IDX_4B365660D71E064B ON stock (id_article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6686C99331');
        $this->addSql('DROP INDEX IDX_23A0E6686C99331 ON article');
        $this->addSql('ALTER TABLE article DROP id_type_article_id');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656608583EA34');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660D71E064B');
        $this->addSql('DROP INDEX IDX_4B3656608583EA34 ON stock');
        $this->addSql('DROP INDEX IDX_4B365660D71E064B ON stock');
        $this->addSql('ALTER TABLE stock DROP id_magasin_id, DROP id_article_id');
    }
}
