<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219000916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE marque_page (id INT AUTO_INCREMENT NOT NULL, url LONGTEXT NOT NULL, date_de_creation DATE NOT NULL, commentaire LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque_page_mots_cles (marque_page_id INT NOT NULL, mots_cles_id INT NOT NULL, INDEX IDX_DD7D38C7D59CC0F1 (marque_page_id), INDEX IDX_DD7D38C7C0BE80DB (mots_cles_id), PRIMARY KEY(marque_page_id, mots_cles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mots_cles (id INT AUTO_INCREMENT NOT NULL, mots VARCHAR(255) NOT NULL, idmrp INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE marque_page_mots_cles ADD CONSTRAINT FK_DD7D38C7D59CC0F1 FOREIGN KEY (marque_page_id) REFERENCES marque_page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marque_page_mots_cles ADD CONSTRAINT FK_DD7D38C7C0BE80DB FOREIGN KEY (mots_cles_id) REFERENCES mots_cles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque_page_mots_cles DROP FOREIGN KEY FK_DD7D38C7D59CC0F1');
        $this->addSql('ALTER TABLE marque_page_mots_cles DROP FOREIGN KEY FK_DD7D38C7C0BE80DB');
        $this->addSql('DROP TABLE marque_page');
        $this->addSql('DROP TABLE marque_page_mots_cles');
        $this->addSql('DROP TABLE mots_cles');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
