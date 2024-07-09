<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240709140322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ee ADD anonymat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ee ADD CONSTRAINT FK_648B18CA67DDCC43 FOREIGN KEY (anonymat_id) REFERENCES anonymat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_648B18CA67DDCC43 ON ee (anonymat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ee DROP FOREIGN KEY FK_648B18CA67DDCC43');
        $this->addSql('DROP INDEX UNIQ_648B18CA67DDCC43 ON ee');
        $this->addSql('ALTER TABLE ee DROP anonymat_id');
    }
}
