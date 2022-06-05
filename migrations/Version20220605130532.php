<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605130532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservation_art_work');
        $this->addSql('ALTER TABLE reservation ADD price NUMERIC(10, 3) NOT NULL, CHANGE name image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_art_work (reservation_id INT NOT NULL, art_work_id INT NOT NULL, INDEX IDX_C7DBFC0BF7052A7 (art_work_id), INDEX IDX_C7DBFC0BB83297E7 (reservation_id), PRIMARY KEY(reservation_id, art_work_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservation_art_work ADD CONSTRAINT FK_C7DBFC0BB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_art_work ADD CONSTRAINT FK_C7DBFC0BF7052A7 FOREIGN KEY (art_work_id) REFERENCES art_work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP price, CHANGE image name VARCHAR(255) NOT NULL');
    }
}
