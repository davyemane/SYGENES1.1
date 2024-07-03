<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703153245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B62E883B1');
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B443707B0');
        $this->addSql('DROP TABLE field_ue');
        $this->addSql('ALTER TABLE field DROP FOREIGN KEY FK_5BF545585FB14BA7');
        $this->addSql('DROP INDEX IDX_5BF545585FB14BA7 ON field');
        $this->addSql('ALTER TABLE field DROP level_id');
        $this->addSql('ALTER TABLE level ADD field_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE level ADD CONSTRAINT FK_9AEACC13443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('CREATE INDEX IDX_9AEACC13443707B0 ON level (field_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE field_ue (field_id INT NOT NULL, ue_id INT NOT NULL, INDEX IDX_D5476A7B443707B0 (field_id), INDEX IDX_D5476A7B62E883B1 (ue_id), PRIMARY KEY(field_id, ue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE level DROP FOREIGN KEY FK_9AEACC13443707B0');
        $this->addSql('DROP INDEX IDX_9AEACC13443707B0 ON level');
        $this->addSql('ALTER TABLE level DROP field_id');
        $this->addSql('ALTER TABLE field ADD level_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF545585FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5BF545585FB14BA7 ON field (level_id)');
    }
}
