<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230831075858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE exchange_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE exchange (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');

        $this->addSql("INSERT INTO exchange (id, libelle, url) VALUES (1, 'Binance', 'https://www.binance.com/fr')");
        $this->addSql("INSERT INTO exchange (id, libelle, url) VALUES (2, 'Coinbase', 'https://www.coinbase.com/fr')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE exchange_id_seq CASCADE');
        $this->addSql('DROP TABLE exchange');
    }
}
