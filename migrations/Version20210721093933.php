<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721093933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE about (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, sub_title VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, legal_mention VARCHAR(255) NOT NULL, timetable VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, rate NUMERIC(10, 2) NOT NULL, timetable VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_AC74095A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_coach (activity_id INT NOT NULL, coach_id INT NOT NULL, INDEX IDX_215B5B7F81C06096 (activity_id), INDEX IDX_215B5B7F3C105691 (coach_id), PRIMARY KEY(activity_id, coach_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, avatar_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_3F596DCC86383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_upload (id INT AUTO_INCREMENT NOT NULL, activity_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_B8A0B8D781C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE activity_coach ADD CONSTRAINT FK_215B5B7F81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_coach ADD CONSTRAINT FK_215B5B7F3C105691 FOREIGN KEY (coach_id) REFERENCES coach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC86383B10 FOREIGN KEY (avatar_id) REFERENCES image_upload (id)');
        $this->addSql('ALTER TABLE image_upload ADD CONSTRAINT FK_B8A0B8D781C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_coach DROP FOREIGN KEY FK_215B5B7F81C06096');
        $this->addSql('ALTER TABLE image_upload DROP FOREIGN KEY FK_B8A0B8D781C06096');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A12469DE2');
        $this->addSql('ALTER TABLE activity_coach DROP FOREIGN KEY FK_215B5B7F3C105691');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC86383B10');
        $this->addSql('DROP TABLE about');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_coach');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE image_upload');
        $this->addSql('DROP TABLE user');
    }
}
