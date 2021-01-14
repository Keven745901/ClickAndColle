<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218084924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD id_magasin_id INT NOT NULL, ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8583EA34 FOREIGN KEY (id_magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8583EA34 ON commande (id_magasin_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D79F37AE5 ON commande (id_user_id)');
        $this->addSql('ALTER TABLE contenir ADD id_article_id INT NOT NULL');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFDD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_3C914DFDD71E064B ON contenir (id_article_id)');
        $this->addSql('ALTER TABLE creneau ADD id_magasin_id INT NOT NULL, ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE creneau ADD CONSTRAINT FK_F9668B5F8583EA34 FOREIGN KEY (id_magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE creneau ADD CONSTRAINT FK_F9668B5F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F9668B5F8583EA34 ON creneau (id_magasin_id)');
        $this->addSql('CREATE INDEX IDX_F9668B5F79F37AE5 ON creneau (id_user_id)');
        $this->addSql('ALTER TABLE message ADD id_vendeur_id INT NOT NULL, ADD id_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F20068689 FOREIGN KEY (id_vendeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F99DED506 FOREIGN KEY (id_client_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F20068689 ON message (id_vendeur_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F99DED506 ON message (id_client_id)');
        $this->addSql('ALTER TABLE type_article ADD description VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8583EA34');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D79F37AE5');
        $this->addSql('DROP INDEX IDX_6EEAA67D8583EA34 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D79F37AE5 ON commande');
        $this->addSql('ALTER TABLE commande DROP id_magasin_id, DROP id_user_id');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFDD71E064B');
        $this->addSql('DROP INDEX IDX_3C914DFDD71E064B ON contenir');
        $this->addSql('ALTER TABLE contenir DROP id_article_id');
        $this->addSql('ALTER TABLE creneau DROP FOREIGN KEY FK_F9668B5F8583EA34');
        $this->addSql('ALTER TABLE creneau DROP FOREIGN KEY FK_F9668B5F79F37AE5');
        $this->addSql('DROP INDEX IDX_F9668B5F8583EA34 ON creneau');
        $this->addSql('DROP INDEX IDX_F9668B5F79F37AE5 ON creneau');
        $this->addSql('ALTER TABLE creneau DROP id_magasin_id, DROP id_user_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F20068689');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F99DED506');
        $this->addSql('DROP INDEX IDX_B6BD307F20068689 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F99DED506 ON message');
        $this->addSql('ALTER TABLE message DROP id_vendeur_id, DROP id_client_id');
        $this->addSql('ALTER TABLE type_article DROP description');
    }
}
