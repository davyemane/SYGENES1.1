<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240708105519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_cc_tp ADD student_id INT DEFAULT NULL, ADD createb_by_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE note_cc_tp ADD CONSTRAINT FK_2885A5F9CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE note_cc_tp ADD CONSTRAINT FK_2885A5F9D3EAB6BC FOREIGN KEY (createb_by_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2885A5F9CB944F1A ON note_cc_tp (student_id)');
        $this->addSql('CREATE INDEX IDX_2885A5F9D3EAB6BC ON note_cc_tp (createb_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_cc_tp DROP FOREIGN KEY FK_2885A5F9CB944F1A');
        $this->addSql('ALTER TABLE note_cc_tp DROP FOREIGN KEY FK_2885A5F9D3EAB6BC');
        $this->addSql('DROP INDEX UNIQ_2885A5F9CB944F1A ON note_cc_tp');
        $this->addSql('DROP INDEX IDX_2885A5F9D3EAB6BC ON note_cc_tp');
        $this->addSql('ALTER TABLE note_cc_tp DROP student_id, DROP createb_by_id, DROP created_at');
    }
}
