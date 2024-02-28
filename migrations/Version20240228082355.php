<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228082355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caillou ADD id INT AUTO_INCREMENT NOT NULL, DROP auteurs, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX auteur_id ON livres');
        $this->addSql('ALTER TABLE livres CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE auteur_id auteur_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caillou MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON caillou');
        $this->addSql('ALTER TABLE caillou ADD auteurs VARCHAR(255) NOT NULL, DROP id');
        $this->addSql('ALTER TABLE caillou ADD PRIMARY KEY (auteurs)');
        $this->addSql('ALTER TABLE livres CHANGE titre titre VARCHAR(255) DEFAULT NULL, CHANGE auteur_id auteur_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX auteur_id ON livres (auteur_id)');
    }
}
