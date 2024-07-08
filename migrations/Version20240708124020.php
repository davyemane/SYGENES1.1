<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240708124020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE field_ue (field_id INT NOT NULL, ue_id INT NOT NULL, INDEX IDX_D5476A7B443707B0 (field_id), INDEX IDX_D5476A7B62E883B1 (ue_id), PRIMARY KEY(field_id, ue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B443707B0');
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B62E883B1');
        $this->addSql('DROP TABLE field_ue');
    }
}
