<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229063744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livres ADD annee_parution DATE NOT NULL, ADD nb_page INT NOT NULL, CHANGE titre titre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livres RENAME INDEX auteur_id TO IDX_927187A460BB6FE6');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A460BB6FE6');
        $this->addSql('ALTER TABLE livres DROP annee_parution, DROP nb_page, CHANGE titre titre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE livres RENAME INDEX idx_927187a460bb6fe6 TO auteur_id');
    }
}
