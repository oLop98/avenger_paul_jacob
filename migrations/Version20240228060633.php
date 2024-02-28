<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228060633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caillou ADD auteurs VARCHAR(255) NOT NULL, DROP id, DROP PRIMARY KEY, ADD PRIMARY KEY (auteurs)');
        $this->addSql('ALTER TABLE livres ADD auteurs VARCHAR(255) NOT NULL, DROP id, DROP PRIMARY KEY, ADD PRIMARY KEY (auteurs)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caillou ADD id INT AUTO_INCREMENT NOT NULL, DROP auteurs, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE livres ADD id INT AUTO_INCREMENT NOT NULL, DROP auteurs, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
