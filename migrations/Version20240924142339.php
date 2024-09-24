<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240924142339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, novel_id INT NOT NULL, name VARCHAR(125) NOT NULL, content LONGTEXT NOT NULL, publish_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_publish TINYINT(1) NOT NULL, INDEX IDX_F981B52EB9E41394 (novel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE novel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(125) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, synopsis LONGTEXT NOT NULL, updated_at DATETIME NOT NULL, validation TINYINT(1) NOT NULL, is_publish TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE novel_genre (novel_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_A6C71FF9B9E41394 (novel_id), INDEX IDX_A6C71FF94296D31F (genre_id), PRIMARY KEY(novel_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52EB9E41394 FOREIGN KEY (novel_id) REFERENCES novel (id)');
        $this->addSql('ALTER TABLE novel_genre ADD CONSTRAINT FK_A6C71FF9B9E41394 FOREIGN KEY (novel_id) REFERENCES novel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE novel_genre ADD CONSTRAINT FK_A6C71FF94296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52EB9E41394');
        $this->addSql('ALTER TABLE novel_genre DROP FOREIGN KEY FK_A6C71FF9B9E41394');
        $this->addSql('ALTER TABLE novel_genre DROP FOREIGN KEY FK_A6C71FF94296D31F');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE novel');
        $this->addSql('DROP TABLE novel_genre');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
