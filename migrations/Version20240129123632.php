<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129123632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD company VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD client VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE project ALTER updated_at SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project DROP company');
        $this->addSql('ALTER TABLE project DROP client');
        $this->addSql('ALTER TABLE project ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE project ALTER updated_at DROP NOT NULL');
    }
}
