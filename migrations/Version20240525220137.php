<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525220137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68C27634BEF');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CCB944F1A');
        $this->addSql('ALTER TABLE teach DROP FOREIGN KEY FK_8224C63A7D2D84D5');
        $this->addSql('ALTER TABLE teach DROP FOREIGN KEY FK_8224C63A27634BEF');
        $this->addSql('ALTER TABLE ue_student DROP FOREIGN KEY FK_43577366CB944F1A');
        $this->addSql('ALTER TABLE ue_student DROP FOREIGN KEY FK_4357736662E883B1');
        $this->addSql('ALTER TABLE ue_field DROP FOREIGN KEY FK_38132BB862E883B1');
        $this->addSql('ALTER TABLE ue_field DROP FOREIGN KEY FK_38132BB8443707B0');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE prefessor');
        $this->addSql('DROP TABLE notes');
        $this->addSql('DROP TABLE teach');
        $this->addSql('DROP TABLE ue_student');
        $this->addSql('DROP TABLE ue_field');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E0FB7336F0 (queue_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prefessor (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, phone_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, ec_id INT DEFAULT NULL, note_cc DOUBLE PRECISION NOT NULL, note_sn DOUBLE PRECISION NOT NULL, note_tp DOUBLE PRECISION DEFAULT NULL, note_rattrapge DOUBLE PRECISION DEFAULT NULL, INDEX IDX_11BA68CCB944F1A (student_id), INDEX IDX_11BA68C27634BEF (ec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE teach (id INT AUTO_INCREMENT NOT NULL, professor_id INT NOT NULL, ec_id INT NOT NULL, teach_date DATE NOT NULL, duration VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_8224C63A7D2D84D5 (professor_id), INDEX IDX_8224C63A27634BEF (ec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ue_student (ue_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_4357736662E883B1 (ue_id), INDEX IDX_43577366CB944F1A (student_id), PRIMARY KEY(ue_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ue_field (ue_id INT NOT NULL, field_id INT NOT NULL, INDEX IDX_38132BB862E883B1 (ue_id), INDEX IDX_38132BB8443707B0 (field_id), PRIMARY KEY(ue_id, field_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C27634BEF FOREIGN KEY (ec_id) REFERENCES ec (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE teach ADD CONSTRAINT FK_8224C63A7D2D84D5 FOREIGN KEY (professor_id) REFERENCES prefessor (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE teach ADD CONSTRAINT FK_8224C63A27634BEF FOREIGN KEY (ec_id) REFERENCES ec (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ue_student ADD CONSTRAINT FK_43577366CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_student ADD CONSTRAINT FK_4357736662E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_field ADD CONSTRAINT FK_38132BB862E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_field ADD CONSTRAINT FK_38132BB8443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
