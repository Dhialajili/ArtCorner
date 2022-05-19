<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519111516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687A832C1C9');
        $this->addSql('DROP INDEX UNIQ_1599687A832C1C9 ON artist');
        $this->addSql('ALTER TABLE artist DROP email_id');
        $this->addSql('ALTER TABLE user ADD artist_id INT DEFAULT NULL, ADD professional_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DB77003 FOREIGN KEY (professional_id) REFERENCES professional_profile (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649B7970CF8 ON user (artist_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649DB77003 ON user (professional_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist ADD email_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687A832C1C9 FOREIGN KEY (email_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1599687A832C1C9 ON artist (email_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B7970CF8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DB77003');
        $this->addSql('DROP INDEX UNIQ_8D93D649B7970CF8 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649DB77003 ON user');
        $this->addSql('ALTER TABLE user DROP artist_id, DROP professional_id');
    }
}
