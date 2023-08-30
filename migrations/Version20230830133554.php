<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\FiatCurrency;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230830133554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE fiat_currency_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE fiat_currency (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, fixer_key VARCHAR(5) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, symbol VARCHAR(5) NOT NULL, rates TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN fiat_currency.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN fiat_currency.rates IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE "user" ADD favorite_fiat_currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64988180915 FOREIGN KEY (favorite_fiat_currency_id) REFERENCES fiat_currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D64988180915 ON "user" (favorite_fiat_currency_id)');

        $KEY_USD = FiatCurrency::$KEY_USD;
        $this->addSql("INSERT INTO fiat_currency (id, libelle, fixer_key, updated_at, symbol, rates) VALUES (1, 'US Dollar', '$KEY_USD', NULL, '$', NULL)");
        $KEY_EUR = FiatCurrency::$KEY_EUR;
        $this->addSql("INSERT INTO fiat_currency (id, libelle, fixer_key, updated_at, symbol, rates) VALUES (2, 'Euro', '$KEY_EUR', NULL, '€', NULL)");
        $KEY_AUD = FiatCurrency::$KEY_AUD;
        $this->addSql("INSERT INTO fiat_currency (id, libelle, fixer_key, updated_at, symbol, rates) VALUES (3, 'Australian Dollar', '$KEY_AUD', NULL, '\$A', NULL)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64988180915');
        $this->addSql('DROP SEQUENCE fiat_currency_id_seq CASCADE');
        $this->addSql('DROP TABLE fiat_currency');
        $this->addSql('DROP INDEX IDX_8D93D64988180915');
        $this->addSql('ALTER TABLE "user" DROP favorite_fiat_currency_id');
    }
}
