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
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE report ADD nom_animal VARCHAR(255) NOT NULL, ADD race VARCHAR(255) NOT NULL, ADD commentaires VARCHAR(255) NOT NULL, DROP created_at, CHANGE detail habitat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE service_page ADD content2 VARCHAR(255) NOT NULL, ADD content3 VARCHAR(255) NOT NULL, CHANGE content content1 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user DROP nom');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, hashed_token VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE report ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD detail VARCHAR(255) NOT NULL, DROP habitat, DROP nom_animal, DROP race, DROP commentaires');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE service_page ADD content VARCHAR(255) NOT NULL, DROP content1, DROP content2, DROP content3');
    }
}
