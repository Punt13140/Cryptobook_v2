<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230811020420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE couple_cryptocurrency_nbcoins_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryptocurrency_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_wallet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE wallet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE couple_cryptocurrency_nbcoins (id INT NOT NULL, coin_id INT NOT NULL, owner_id INT DEFAULT NULL, wallet_id INT DEFAULT NULL, nb_coins DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_193EB2D584BBDA7 ON couple_cryptocurrency_nbcoins (coin_id)');
        $this->addSql('CREATE INDEX IDX_193EB2D57E3C61F9 ON couple_cryptocurrency_nbcoins (owner_id)');
        $this->addSql('CREATE INDEX IDX_193EB2D5712520F3 ON couple_cryptocurrency_nbcoins (wallet_id)');
        $this->addSql('CREATE TABLE cryptocurrency (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, libelle_coingecko VARCHAR(255) NOT NULL, price_usd DOUBLE PRECISION NOT NULL, mcap_usd DOUBLE PRECISION NOT NULL, url_img_thumb VARCHAR(255) DEFAULT NULL, url_img_small VARCHAR(255) DEFAULT NULL, url_img_large VARCHAR(255) DEFAULT NULL, symbol VARCHAR(8) NOT NULL, color VARCHAR(10) DEFAULT NULL, is_stable BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_wallet (id INT NOT NULL, libelle VARCHAR(64) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE wallet (id INT NOT NULL, type_id INT NOT NULL, owner_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, information VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7C68921FC54C8C93 ON wallet (type_id)');
        $this->addSql('CREATE INDEX IDX_7C68921F7E3C61F9 ON wallet (owner_id)');
        $this->addSql('ALTER TABLE couple_cryptocurrency_nbcoins ADD CONSTRAINT FK_193EB2D584BBDA7 FOREIGN KEY (coin_id) REFERENCES cryptocurrency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE couple_cryptocurrency_nbcoins ADD CONSTRAINT FK_193EB2D57E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE couple_cryptocurrency_nbcoins ADD CONSTRAINT FK_193EB2D5712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921FC54C8C93 FOREIGN KEY (type_id) REFERENCES type_wallet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE couple_cryptocurrency_nbcoins_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cryptocurrency_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_wallet_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE wallet_id_seq CASCADE');
        $this->addSql('ALTER TABLE couple_cryptocurrency_nbcoins DROP CONSTRAINT FK_193EB2D584BBDA7');
        $this->addSql('ALTER TABLE couple_cryptocurrency_nbcoins DROP CONSTRAINT FK_193EB2D57E3C61F9');
        $this->addSql('ALTER TABLE couple_cryptocurrency_nbcoins DROP CONSTRAINT FK_193EB2D5712520F3');
        $this->addSql('ALTER TABLE wallet DROP CONSTRAINT FK_7C68921FC54C8C93');
        $this->addSql('ALTER TABLE wallet DROP CONSTRAINT FK_7C68921F7E3C61F9');
        $this->addSql('DROP TABLE couple_cryptocurrency_nbcoins');
        $this->addSql('DROP TABLE cryptocurrency');
        $this->addSql('DROP TABLE type_wallet');
        $this->addSql('DROP TABLE wallet');
    }
}
