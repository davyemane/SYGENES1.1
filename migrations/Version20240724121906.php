<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724121906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher DROP INDEX UNIQ_B0F6A6D5B03A8386, ADD INDEX IDX_B0F6A6D5B03A8386 (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher DROP INDEX IDX_B0F6A6D5B03A8386, ADD UNIQUE INDEX UNIQ_B0F6A6D5B03A8386 (created_by_id)');
    }
}