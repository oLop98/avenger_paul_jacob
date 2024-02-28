<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228082531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caillou (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, photo_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX auteur_id ON livres');
        $this->addSql('ALTER TABLE livres CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE auteur_id auteur_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE caillou');
        $this->addSql('ALTER TABLE livres CHANGE titre titre VARCHAR(255) DEFAULT NULL, CHANGE auteur_id auteur_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX auteur_id ON livres (auteur_id)');
    }
}
