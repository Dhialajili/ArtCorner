<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519110356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687A76ED395');
        $this->addSql('DROP INDEX UNIQ_1599687A76ED395 ON artist');
        $this->addSql('ALTER TABLE artist ADD email_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687A832C1C9 FOREIGN KEY (email_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1599687A832C1C9 ON artist (email_id)');
        $this->addSql('ALTER TABLE professional_profile DROP FOREIGN KEY FK_E728A82A76ED395');
        $this->addSql('DROP INDEX UNIQ_E728A82A76ED395 ON professional_profile');
        $this->addSql('ALTER TABLE professional_profile ADD email_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE professional_profile ADD CONSTRAINT FK_E728A82A832C1C9 FOREIGN KEY (email_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E728A82A832C1C9 ON professional_profile (email_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492F85CDC1');
        $this->addSql('DROP INDEX UNIQ_8D93D6492F85CDC1 ON user');
        $this->addSql('ALTER TABLE user DROP artist_profile_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687A832C1C9');
        $this->addSql('DROP INDEX UNIQ_1599687A832C1C9 ON artist');
        $this->addSql('ALTER TABLE artist ADD user_id INT NOT NULL, DROP email_id');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1599687A76ED395 ON artist (user_id)');
        $this->addSql('ALTER TABLE professional_profile DROP FOREIGN KEY FK_E728A82A832C1C9');
        $this->addSql('DROP INDEX UNIQ_E728A82A832C1C9 ON professional_profile');
        $this->addSql('ALTER TABLE professional_profile ADD user_id INT NOT NULL, DROP email_id');
        $this->addSql('ALTER TABLE professional_profile ADD CONSTRAINT FK_E728A82A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E728A82A76ED395 ON professional_profile (user_id)');
        $this->addSql('ALTER TABLE user ADD artist_profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492F85CDC1 FOREIGN KEY (artist_profile_id) REFERENCES artist (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6492F85CDC1 ON user (artist_profile_id)');
    }
}
