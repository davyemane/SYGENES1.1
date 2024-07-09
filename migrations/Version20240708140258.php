<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240708140258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_cc_tp DROP INDEX UNIQ_2885A5F9CB944F1A, ADD INDEX IDX_2885A5F9CB944F1A (student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_cc_tp DROP INDEX IDX_2885A5F9CB944F1A, ADD UNIQUE INDEX UNIQ_2885A5F9CB944F1A (student_id)');
    }
}
