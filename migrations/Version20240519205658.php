<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240519205658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, createb_by_id INT DEFAULT NULL, student_id INT DEFAULT NULL, ec_id INT DEFAULT NULL, cc VARCHAR(255) DEFAULT NULL, tp VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, rattrapage VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CFBDFA14D3EAB6BC (createb_by_id), INDEX IDX_CFBDFA14CB944F1A (student_id), INDEX IDX_CFBDFA1427634BEF (ec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14D3EAB6BC FOREIGN KEY (createb_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1427634BEF FOREIGN KEY (ec_id) REFERENCES ec (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14D3EAB6BC');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14CB944F1A');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1427634BEF');
        $this->addSql('DROP TABLE note');
    }
}
