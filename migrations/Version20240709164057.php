<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240709164057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anonymat_rattrapage (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, e_c_id INT DEFAULT NULL, code_anonymat VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_3E2D843DCB944F1A (student_id), INDEX IDX_3E2D843DE32B239F (e_c_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rattrapage (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, anonymat_rattrapage_id INT DEFAULT NULL, mark DOUBLE PRECISION DEFAULT NULL, grade VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_BDE5586DB03A8386 (created_by_id), UNIQUE INDEX UNIQ_BDE5586D50C2B2F7 (anonymat_rattrapage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anonymat_rattrapage ADD CONSTRAINT FK_3E2D843DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE anonymat_rattrapage ADD CONSTRAINT FK_3E2D843DE32B239F FOREIGN KEY (e_c_id) REFERENCES ec (id)');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586DB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586D50C2B2F7 FOREIGN KEY (anonymat_rattrapage_id) REFERENCES anonymat_rattrapage (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anonymat_rattrapage DROP FOREIGN KEY FK_3E2D843DCB944F1A');
        $this->addSql('ALTER TABLE anonymat_rattrapage DROP FOREIGN KEY FK_3E2D843DE32B239F');
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586DB03A8386');
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586D50C2B2F7');
        $this->addSql('DROP TABLE anonymat_rattrapage');
        $this->addSql('DROP TABLE rattrapage');
    }
}
