<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519112333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professional_profile DROP FOREIGN KEY FK_E728A82A832C1C9');
        $this->addSql('DROP INDEX UNIQ_E728A82A832C1C9 ON professional_profile');
        $this->addSql('ALTER TABLE professional_profile DROP email_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professional_profile ADD email_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE professional_profile ADD CONSTRAINT FK_E728A82A832C1C9 FOREIGN KEY (email_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E728A82A832C1C9 ON professional_profile (email_id)');
    }
}
