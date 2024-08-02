<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240729151416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistant_teacher ADD user_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE assistant_teacher ADD CONSTRAINT FK_8C7D7745A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C7D7745A76ED395 ON assistant_teacher (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistant_teacher DROP FOREIGN KEY FK_8C7D7745A76ED395');
        $this->addSql('DROP INDEX UNIQ_8C7D7745A76ED395 ON assistant_teacher');
        $this->addSql('ALTER TABLE assistant_teacher DROP user_id, DROP created_at');
    }
}
