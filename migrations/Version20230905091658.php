<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230905091658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE blockchain_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE dapp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE loan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE blockchain (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE dapp (id INT NOT NULL, blockchain_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A32F169598073AE1 ON dapp (blockchain_id)');
        $this->addSql('CREATE TABLE loan (id INT NOT NULL, owner_id INT NOT NULL, coin_id INT NOT NULL, dapp_id INT NOT NULL, nb_coins DOUBLE PRECISION NOT NULL, loaned_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C5D30D037E3C61F9 ON loan (owner_id)');
        $this->addSql('CREATE INDEX IDX_C5D30D0384BBDA7 ON loan (coin_id)');
        $this->addSql('CREATE INDEX IDX_C5D30D032AD03706 ON loan (dapp_id)');
        $this->addSql('COMMENT ON COLUMN loan.loaned_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE dapp ADD CONSTRAINT FK_A32F169598073AE1 FOREIGN KEY (blockchain_id) REFERENCES blockchain (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D037E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D0384BBDA7 FOREIGN KEY (coin_id) REFERENCES cryptocurrency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D032AD03706 FOREIGN KEY (dapp_id) REFERENCES dapp (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE blockchain_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE dapp_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE loan_id_seq CASCADE');
        $this->addSql('ALTER TABLE dapp DROP CONSTRAINT FK_A32F169598073AE1');
        $this->addSql('ALTER TABLE loan DROP CONSTRAINT FK_C5D30D037E3C61F9');
        $this->addSql('ALTER TABLE loan DROP CONSTRAINT FK_C5D30D0384BBDA7');
        $this->addSql('ALTER TABLE loan DROP CONSTRAINT FK_C5D30D032AD03706');
        $this->addSql('DROP TABLE blockchain');
        $this->addSql('DROP TABLE dapp');
        $this->addSql('DROP TABLE loan');
    }
}
