<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230831080556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE deposit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE deposit (id INT NOT NULL, type_id INT NOT NULL, owner_id INT NOT NULL, exchange_id INT NOT NULL, fiat_currency_id INT NOT NULL, deposited_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_95DB9D39C54C8C93 ON deposit (type_id)');
        $this->addSql('CREATE INDEX IDX_95DB9D397E3C61F9 ON deposit (owner_id)');
        $this->addSql('CREATE INDEX IDX_95DB9D3968AFD1A0 ON deposit (exchange_id)');
        $this->addSql('CREATE INDEX IDX_95DB9D39C4F47010 ON deposit (fiat_currency_id)');
        $this->addSql('COMMENT ON COLUMN deposit.deposited_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D39C54C8C93 FOREIGN KEY (type_id) REFERENCES deposit_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D397E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D3968AFD1A0 FOREIGN KEY (exchange_id) REFERENCES exchange (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D39C4F47010 FOREIGN KEY (fiat_currency_id) REFERENCES fiat_currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE deposit_id_seq CASCADE');
        $this->addSql('ALTER TABLE deposit DROP CONSTRAINT FK_95DB9D39C54C8C93');
        $this->addSql('ALTER TABLE deposit DROP CONSTRAINT FK_95DB9D397E3C61F9');
        $this->addSql('ALTER TABLE deposit DROP CONSTRAINT FK_95DB9D3968AFD1A0');
        $this->addSql('ALTER TABLE deposit DROP CONSTRAINT FK_95DB9D39C4F47010');
        $this->addSql('DROP TABLE deposit');
    }
}
