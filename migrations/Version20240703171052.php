<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703171052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE level_fields (level_id INT NOT NULL, field_id INT NOT NULL, INDEX IDX_75382295FB14BA7 (level_id), INDEX IDX_7538229443707B0 (field_id), PRIMARY KEY(level_id, field_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE level_fields ADD CONSTRAINT FK_75382295FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE level_fields ADD CONSTRAINT FK_7538229443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE level_fields DROP FOREIGN KEY FK_75382295FB14BA7');
        $this->addSql('ALTER TABLE level_fields DROP FOREIGN KEY FK_7538229443707B0');
        $this->addSql('DROP TABLE level_fields');
    }
}
