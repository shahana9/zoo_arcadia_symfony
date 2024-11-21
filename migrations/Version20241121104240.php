<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121104240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal CHANGE date_passage date_passage DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE report ADD prenom_id INT NOT NULL, ADD habitat VARCHAR(255) NOT NULL, ADD race VARCHAR(255) NOT NULL, ADD commentaires VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778458819F9E FOREIGN KEY (prenom_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_C42F778458819F9E ON report (prenom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778458819F9E');
        $this->addSql('DROP INDEX IDX_C42F778458819F9E ON report');
        $this->addSql('ALTER TABLE report DROP prenom_id, DROP habitat, DROP race, DROP commentaires');
        $this->addSql('ALTER TABLE animal CHANGE date_passage date_passage DATETIME NOT NULL');
    }
}
