<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115123809 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, id_type_article_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_23A0E6686C99331 (id_type_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_magasin_id INT NOT NULL, id_user_id INT NOT NULL, date_commande DATETIME NOT NULL, etat_commande INT NOT NULL, INDEX IDX_6EEAA67D8583EA34 (id_magasin_id), INDEX IDX_6EEAA67D79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenir (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT NOT NULL, id_article_id INT NOT NULL, quantite_commandee INT NOT NULL, INDEX IDX_3C914DFD9AF8E3A3 (id_commande_id), INDEX IDX_3C914DFDD71E064B (id_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creneau (id INT AUTO_INCREMENT NOT NULL, id_magasin_id INT NOT NULL, id_user_id INT NOT NULL, date_creneau DATETIME NOT NULL, etat_creneau INT NOT NULL, INDEX IDX_F9668B5F8583EA34 (id_magasin_id), INDEX IDX_F9668B5F79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magasin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, id_vendeur_id INT NOT NULL, id_client_id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date_message DATETIME NOT NULL, INDEX IDX_B6BD307F20068689 (id_vendeur_id), INDEX IDX_B6BD307F99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, id_magasin_id INT NOT NULL, id_article_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_4B3656608583EA34 (id_magasin_id), INDEX IDX_4B365660D71E064B (id_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_article (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6686C99331 FOREIGN KEY (id_type_article_id) REFERENCES type_article (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8583EA34 FOREIGN KEY (id_magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFDD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE creneau ADD CONSTRAINT FK_F9668B5F8583EA34 FOREIGN KEY (id_magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE creneau ADD CONSTRAINT FK_F9668B5F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F20068689 FOREIGN KEY (id_vendeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F99DED506 FOREIGN KEY (id_client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656608583EA34 FOREIGN KEY (id_magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660D71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFDD71E064B');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660D71E064B');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD9AF8E3A3');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8583EA34');
        $this->addSql('ALTER TABLE creneau DROP FOREIGN KEY FK_F9668B5F8583EA34');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656608583EA34');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6686C99331');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D79F37AE5');
        $this->addSql('ALTER TABLE creneau DROP FOREIGN KEY FK_F9668B5F79F37AE5');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F20068689');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F99DED506');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE contenir');
        $this->addSql('DROP TABLE creneau');
        $this->addSql('DROP TABLE magasin');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE type_article');
        $this->addSql('DROP TABLE user');
    }
}
