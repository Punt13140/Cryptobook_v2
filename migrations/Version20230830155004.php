<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\DepositType;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230830155004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE deposit_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE deposit_type (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');

        $KEY_CB = DepositType::$CB;
        $this->addSql("INSERT INTO deposit_type (id, libelle) VALUES ($KEY_CB, 'Carte bleu')");
        $KEY_VIREMENT = DepositType::$VIREMENT;
        $this->addSql("INSERT INTO deposit_type (id, libelle) VALUES ($KEY_VIREMENT, 'Virement Bancaire')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE deposit_type_id_seq CASCADE');
        $this->addSql('DROP TABLE deposit_type');
    }
}
