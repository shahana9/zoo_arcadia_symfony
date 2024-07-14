<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240708181012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_page ADD sub_title2 VARCHAR(255) NOT NULL, ADD sub_title3 VARCHAR(255) NOT NULL, CHANGE images images VARCHAR(255) DEFAULT NULL, CHANGE sub_title sub_title1 VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_page ADD sub_title VARCHAR(255) NOT NULL, DROP sub_title1, DROP sub_title2, DROP sub_title3, CHANGE images images VARCHAR(255) NOT NULL');
    }
}
