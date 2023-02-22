<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222232328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_posts (category_id INT NOT NULL, posts_id INT NOT NULL, INDEX IDX_606EF5B312469DE2 (category_id), INDEX IDX_606EF5B3D5E258C5 (posts_id), PRIMARY KEY(category_id, posts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_posts ADD CONSTRAINT FK_606EF5B312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_posts ADD CONSTRAINT FK_606EF5B3D5E258C5 FOREIGN KEY (posts_id) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category CHANGE description description TINYTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_posts DROP FOREIGN KEY FK_606EF5B312469DE2');
        $this->addSql('ALTER TABLE category_posts DROP FOREIGN KEY FK_606EF5B3D5E258C5');
        $this->addSql('DROP TABLE category_posts');
        $this->addSql('ALTER TABLE category CHANGE description description LONGTEXT DEFAULT NULL');
    }
}
