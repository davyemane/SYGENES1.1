<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240505193412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE field_ue (field_id INT NOT NULL, ue_id INT NOT NULL, INDEX IDX_D5476A7B443707B0 (field_id), INDEX IDX_D5476A7B62E883B1 (ue_id), PRIMARY KEY(field_id, ue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_student DROP FOREIGN KEY FK_4357736662E883B1');
        $this->addSql('ALTER TABLE ue_student DROP FOREIGN KEY FK_43577366CB944F1A');
        $this->addSql('ALTER TABLE ue_field DROP FOREIGN KEY FK_38132BB8443707B0');
        $this->addSql('ALTER TABLE ue_field DROP FOREIGN KEY FK_38132BB862E883B1');
        $this->addSql('ALTER TABLE teach DROP FOREIGN KEY FK_8224C63A27634BEF');
        $this->addSql('ALTER TABLE teach DROP FOREIGN KEY FK_8224C63A7D2D84D5');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68C27634BEF');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CCB944F1A');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE ue_student');
        $this->addSql('DROP TABLE ue_field');
        $this->addSql('DROP TABLE prefessor');
        $this->addSql('DROP TABLE teach');
        $this->addSql('DROP TABLE notes');
        $this->addSql('ALTER TABLE ec ADD code VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, DROP code_ec, DROP descrption, DROP credit, CHANGE ue_id ue_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE field CHANGE code code VARCHAR(255) DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE descrption description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE level ADD name VARCHAR(255) DEFAULT NULL, DROP level_number');
        $this->addSql('ALTER TABLE responsable CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE student DROP birth_certificate, DROP admission_certificate, CHANGE field_id field_id INT DEFAULT NULL, CHANGE level_id level_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE date_of_birth date_of_birth DATE DEFAULT NULL, CHANGE place_of_birth place_of_birth LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE take_ue DROP FOREIGN KEY FK_AC89C73D5FB14BA7');
        $this->addSql('ALTER TABLE take_ue DROP FOREIGN KEY FK_AC89C73D62E883B1');
        $this->addSql('DROP INDEX IDX_AC89C73D62E883B1 ON take_ue');
        $this->addSql('DROP INDEX IDX_AC89C73D5FB14BA7 ON take_ue');
        $this->addSql('ALTER TABLE take_ue ADD ue VARCHAR(255) DEFAULT NULL, DROP ue_id, DROP level_id, DROP academic_year, CHANGE grade grade VARCHAR(50) DEFAULT NULL, CHANGE semester semester INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ue ADD code VARCHAR(255) DEFAULT NULL, DROP code_ue, DROP description, DROP semester, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE credit credit INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E0FB7336F0 (queue_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ue_student (ue_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_43577366CB944F1A (student_id), INDEX IDX_4357736662E883B1 (ue_id), PRIMARY KEY(ue_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ue_field (ue_id INT NOT NULL, field_id INT NOT NULL, INDEX IDX_38132BB862E883B1 (ue_id), INDEX IDX_38132BB8443707B0 (field_id), PRIMARY KEY(ue_id, field_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prefessor (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, phone_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE teach (id INT AUTO_INCREMENT NOT NULL, professor_id INT NOT NULL, ec_id INT NOT NULL, teach_date DATE NOT NULL, duration VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_8224C63A7D2D84D5 (professor_id), INDEX IDX_8224C63A27634BEF (ec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, ec_id INT DEFAULT NULL, note_cc DOUBLE PRECISION NOT NULL, note_sn DOUBLE PRECISION NOT NULL, note_tp DOUBLE PRECISION DEFAULT NULL, note_rattrapge DOUBLE PRECISION DEFAULT NULL, INDEX IDX_11BA68C27634BEF (ec_id), INDEX IDX_11BA68CCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ue_student ADD CONSTRAINT FK_4357736662E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_student ADD CONSTRAINT FK_43577366CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_field ADD CONSTRAINT FK_38132BB8443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_field ADD CONSTRAINT FK_38132BB862E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teach ADD CONSTRAINT FK_8224C63A27634BEF FOREIGN KEY (ec_id) REFERENCES ec (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE teach ADD CONSTRAINT FK_8224C63A7D2D84D5 FOREIGN KEY (professor_id) REFERENCES prefessor (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C27634BEF FOREIGN KEY (ec_id) REFERENCES ec (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B443707B0');
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B62E883B1');
        $this->addSql('DROP TABLE field_ue');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('ALTER TABLE responsable CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ec ADD code_ec VARCHAR(255) NOT NULL, ADD descrption LONGTEXT DEFAULT NULL, ADD credit INT NOT NULL, DROP code, DROP description, CHANGE ue_id ue_id INT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE field CHANGE code code VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(55) NOT NULL, CHANGE description descrption VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ue ADD code_ue VARCHAR(255) NOT NULL, ADD description LONGTEXT DEFAULT NULL, ADD semester VARCHAR(255) NOT NULL, DROP code, CHANGE name name VARCHAR(255) NOT NULL, CHANGE credit credit INT NOT NULL');
        $this->addSql('ALTER TABLE level ADD level_number VARCHAR(255) NOT NULL, DROP name');
        $this->addSql('ALTER TABLE student ADD birth_certificate LONGTEXT DEFAULT NULL, ADD admission_certificate LONGTEXT DEFAULT NULL, CHANGE field_id field_id INT NOT NULL, CHANGE level_id level_id INT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE date_of_birth date_of_birth DATE NOT NULL, CHANGE place_of_birth place_of_birth LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE take_ue ADD ue_id INT NOT NULL, ADD level_id INT DEFAULT NULL, ADD academic_year VARCHAR(255) NOT NULL, DROP ue, CHANGE grade grade VARCHAR(5) DEFAULT NULL, CHANGE semester semester INT NOT NULL');
        $this->addSql('ALTER TABLE take_ue ADD CONSTRAINT FK_AC89C73D5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE take_ue ADD CONSTRAINT FK_AC89C73D62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AC89C73D62E883B1 ON take_ue (ue_id)');
        $this->addSql('CREATE INDEX IDX_AC89C73D5FB14BA7 ON take_ue (level_id)');
    }
}
