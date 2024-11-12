<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241016100400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report ADD nom_animal VARCHAR(255) NOT NULL, ADD race VARCHAR(255) NOT NULL, ADD commentaires VARCHAR(255) NOT NULL, DROP created_at, CHANGE detail habitat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE service_page ADD content2 VARCHAR(255) NOT NULL, ADD content3 VARCHAR(255) NOT NULL, CHANGE content content1 VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE report ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD detail VARCHAR(255) NOT NULL, DROP habitat, DROP nom_animal, DROP race, DROP commentaires');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE service_page ADD content VARCHAR(255) NOT NULL, DROP content1, DROP content2, DROP content3');
    }
}
