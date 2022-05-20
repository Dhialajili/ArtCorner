<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520085604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE art_work ADD artist_id INT DEFAULT NULL, ADD category_id INT NOT NULL, ADD subject_id INT NOT NULL, ADD style_id INT NOT NULL, ADD price NUMERIC(10, 3) NOT NULL');
        $this->addSql('ALTER TABLE art_work ADD CONSTRAINT FK_5A6E1E1FB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE art_work ADD CONSTRAINT FK_5A6E1E1F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE art_work ADD CONSTRAINT FK_5A6E1E1F23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE art_work ADD CONSTRAINT FK_5A6E1E1FBACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('CREATE INDEX IDX_5A6E1E1FB7970CF8 ON art_work (artist_id)');
        $this->addSql('CREATE INDEX IDX_5A6E1E1F12469DE2 ON art_work (category_id)');
        $this->addSql('CREATE INDEX IDX_5A6E1E1F23EDC87 ON art_work (subject_id)');
        $this->addSql('CREATE INDEX IDX_5A6E1E1FBACD6074 ON art_work (style_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE art_work DROP FOREIGN KEY FK_5A6E1E1FB7970CF8');
        $this->addSql('ALTER TABLE art_work DROP FOREIGN KEY FK_5A6E1E1F12469DE2');
        $this->addSql('ALTER TABLE art_work DROP FOREIGN KEY FK_5A6E1E1F23EDC87');
        $this->addSql('ALTER TABLE art_work DROP FOREIGN KEY FK_5A6E1E1FBACD6074');
        $this->addSql('DROP INDEX IDX_5A6E1E1FB7970CF8 ON art_work');
        $this->addSql('DROP INDEX IDX_5A6E1E1F12469DE2 ON art_work');
        $this->addSql('DROP INDEX IDX_5A6E1E1F23EDC87 ON art_work');
        $this->addSql('DROP INDEX IDX_5A6E1E1FBACD6074 ON art_work');
        $this->addSql('ALTER TABLE art_work DROP artist_id, DROP category_id, DROP subject_id, DROP style_id, DROP price');
    }
}
