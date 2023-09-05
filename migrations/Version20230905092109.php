<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230905092109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blockchain ADD coin_id INT NOT NULL');
        $this->addSql('ALTER TABLE blockchain ADD CONSTRAINT FK_2A493AAA84BBDA7 FOREIGN KEY (coin_id) REFERENCES cryptocurrency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2A493AAA84BBDA7 ON blockchain (coin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE blockchain DROP CONSTRAINT FK_2A493AAA84BBDA7');
        $this->addSql('DROP INDEX IDX_2A493AAA84BBDA7');
        $this->addSql('ALTER TABLE blockchain DROP coin_id');
    }
}
