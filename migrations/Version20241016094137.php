<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241016094137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report ADD nom_animal VARCHAR(255) NOT NULL, ADD race VARCHAR(255) NOT NULL, ADD commentaires VARCHAR(255) NOT NULL, DROP created_at, CHANGE detail habitat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user DROP nom');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD detail VARCHAR(255) NOT NULL, DROP habitat, DROP nom_animal, DROP race, DROP commentaires');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL');
    }
}
