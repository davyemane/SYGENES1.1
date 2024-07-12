<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240712121948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anonymat (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, e_c_id INT DEFAULT NULL, anonymat VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_FC64F1CB944F1A (student_id), INDEX IDX_FC64F1E32B239F (e_c_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE anonymat_rattrapage (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, e_c_id INT DEFAULT NULL, code_anonymat VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_3E2D843DCB944F1A (student_id), INDEX IDX_3E2D843DE32B239F (e_c_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color_scheme (id INT AUTO_INCREMENT NOT NULL, school_id INT DEFAULT NULL, primary_color VARCHAR(255) DEFAULT NULL, secondary_color VARCHAR(255) DEFAULT NULL, accent_color VARCHAR(255) DEFAULT NULL, bacground_color VARCHAR(255) DEFAULT NULL, text_color VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_9AFD9BB9C32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ec (id INT AUTO_INCREMENT NOT NULL, ue_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, code_ec VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, credit VARCHAR(255) DEFAULT NULL, has_tp TINYINT(1) NOT NULL, INDEX IDX_8DE8BDFF62E883B1 (ue_id), INDEX IDX_8DE8BDFF41807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ee (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, anonymat_id INT DEFAULT NULL, mark DOUBLE PRECISION DEFAULT NULL, grade VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_648B18CAB03A8386 (created_by_id), UNIQUE INDEX UNIQ_648B18CA67DDCC43 (anonymat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE field (id INT AUTO_INCREMENT NOT NULL, school_id INT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_5BF54558C32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, field_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_9AEACC13443707B0 (field_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level_fields (level_id INT NOT NULL, field_id INT NOT NULL, INDEX IDX_75382295FB14BA7 (level_id), INDEX IDX_7538229443707B0 (field_id), PRIMARY KEY(level_id, field_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, createb_by_id INT DEFAULT NULL, student_id INT DEFAULT NULL, ec_id INT DEFAULT NULL, cc VARCHAR(255) DEFAULT NULL, tp VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, rattrapage VARCHAR(255) DEFAULT NULL, created_at VARCHAR(255) DEFAULT NULL, semester VARCHAR(10) DEFAULT NULL, INDEX IDX_CFBDFA14D3EAB6BC (createb_by_id), INDEX IDX_CFBDFA14CB944F1A (student_id), INDEX IDX_CFBDFA1427634BEF (ec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_cc_tp (id INT AUTO_INCREMENT NOT NULL, e_c_id INT DEFAULT NULL, createb_by_id INT DEFAULT NULL, student_id INT DEFAULT NULL, cc DOUBLE PRECISION DEFAULT NULL, tp DOUBLE PRECISION DEFAULT NULL, has_tp TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_2885A5F9E32B239F (e_c_id), INDEX IDX_2885A5F9D3EAB6BC (createb_by_id), INDEX IDX_2885A5F9CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE privilege (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rattrapage (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, anonymat_rattrapage_id INT DEFAULT NULL, mark DOUBLE PRECISION DEFAULT NULL, grade VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_BDE5586DB03A8386 (created_by_id), UNIQUE INDEX UNIQ_BDE5586D50C2B2F7 (anonymat_rattrapage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resp_field (id INT AUTO_INCREMENT NOT NULL, field_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, cni VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A97AB707443707B0 (field_id), INDEX IDX_A97AB707B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resp_level (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, level_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, cni VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_68653E4CB03A8386 (created_by_id), UNIQUE INDEX UNIQ_68653E4C5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resp_school (id INT AUTO_INCREMENT NOT NULL, school_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, cni VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2B8192CC32A47EE (school_id), INDEX IDX_2B8192CB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resp_ue (id INT AUTO_INCREMENT NOT NULL, ue_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, cni VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_639FCBFF62E883B1 (ue_id), INDEX IDX_639FCBFFB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at VARCHAR(50) DEFAULT NULL, INDEX IDX_52520D07B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, school_id INT DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_57698A6AC32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_privilege (role_id INT NOT NULL, privilege_id INT NOT NULL, INDEX IDX_D6D4495BD60322AC (role_id), INDEX IDX_D6D4495B32FB8AEA (privilege_id), PRIMARY KEY(role_id, privilege_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, field_id INT DEFAULT NULL, level_id INT DEFAULT NULL, student_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, date_of_birth DATE DEFAULT NULL, place_of_birth LONGTEXT DEFAULT NULL, birth_certificate VARCHAR(255) DEFAULT NULL, admission_certificate VARCHAR(255) DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, cni VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, INDEX IDX_B723AF33443707B0 (field_id), INDEX IDX_B723AF335FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE take_ue (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, grade VARCHAR(50) DEFAULT NULL, semester INT DEFAULT NULL, ue VARCHAR(255) DEFAULT NULL, INDEX IDX_AC89C73DCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, cni VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_B0F6A6D5B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, level_id INT DEFAULT NULL, code_ue VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, credit INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, semester VARCHAR(255) DEFAULT NULL, grade DOUBLE PRECISION DEFAULT NULL, academic_year VARCHAR(255) DEFAULT NULL, INDEX IDX_2E490A9B5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue_field (ue_id INT NOT NULL, field_id INT NOT NULL, INDEX IDX_38132BB862E883B1 (ue_id), INDEX IDX_38132BB8443707B0 (field_id), PRIMARY KEY(ue_id, field_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, responsable_id INT DEFAULT NULL, respfield_id INT DEFAULT NULL, respschool_id INT DEFAULT NULL, resplevel_id INT DEFAULT NULL, respue_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649CB944F1A (student_id), UNIQUE INDEX UNIQ_8D93D64953C59D72 (responsable_id), UNIQUE INDEX UNIQ_8D93D6495EEFC6E9 (respfield_id), UNIQUE INDEX UNIQ_8D93D649D187767F (respschool_id), UNIQUE INDEX UNIQ_8D93D64945698AFE (resplevel_id), UNIQUE INDEX UNIQ_8D93D649D23FE2F9 (respue_id), UNIQUE INDEX UNIQ_8D93D64941807E1D (teacher_id), UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anonymat ADD CONSTRAINT FK_FC64F1CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE anonymat ADD CONSTRAINT FK_FC64F1E32B239F FOREIGN KEY (e_c_id) REFERENCES ec (id)');
        $this->addSql('ALTER TABLE anonymat_rattrapage ADD CONSTRAINT FK_3E2D843DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE anonymat_rattrapage ADD CONSTRAINT FK_3E2D843DE32B239F FOREIGN KEY (e_c_id) REFERENCES ec (id)');
        $this->addSql('ALTER TABLE color_scheme ADD CONSTRAINT FK_9AFD9BB9C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE ec ADD CONSTRAINT FK_8DE8BDFF62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE ec ADD CONSTRAINT FK_8DE8BDFF41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE ee ADD CONSTRAINT FK_648B18CAB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ee ADD CONSTRAINT FK_648B18CA67DDCC43 FOREIGN KEY (anonymat_id) REFERENCES anonymat (id)');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF54558C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE level ADD CONSTRAINT FK_9AEACC13443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE level_fields ADD CONSTRAINT FK_75382295FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE level_fields ADD CONSTRAINT FK_7538229443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14D3EAB6BC FOREIGN KEY (createb_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1427634BEF FOREIGN KEY (ec_id) REFERENCES ec (id)');
        $this->addSql('ALTER TABLE note_cc_tp ADD CONSTRAINT FK_2885A5F9E32B239F FOREIGN KEY (e_c_id) REFERENCES ec (id)');
        $this->addSql('ALTER TABLE note_cc_tp ADD CONSTRAINT FK_2885A5F9D3EAB6BC FOREIGN KEY (createb_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE note_cc_tp ADD CONSTRAINT FK_2885A5F9CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586DB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586D50C2B2F7 FOREIGN KEY (anonymat_rattrapage_id) REFERENCES anonymat_rattrapage (id)');
        $this->addSql('ALTER TABLE resp_field ADD CONSTRAINT FK_A97AB707443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE resp_field ADD CONSTRAINT FK_A97AB707B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE resp_level ADD CONSTRAINT FK_68653E4CB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE resp_level ADD CONSTRAINT FK_68653E4C5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE resp_school ADD CONSTRAINT FK_2B8192CC32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE resp_school ADD CONSTRAINT FK_2B8192CB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE resp_ue ADD CONSTRAINT FK_639FCBFF62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE resp_ue ADD CONSTRAINT FK_639FCBFFB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AC32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE role_privilege ADD CONSTRAINT FK_D6D4495BD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_privilege ADD CONSTRAINT FK_D6D4495B32FB8AEA FOREIGN KEY (privilege_id) REFERENCES privilege (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF335FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE take_ue ADD CONSTRAINT FK_AC89C73DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE ue_field ADD CONSTRAINT FK_38132BB862E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_field ADD CONSTRAINT FK_38132BB8443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64953C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6495EEFC6E9 FOREIGN KEY (respfield_id) REFERENCES resp_field (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649D187767F FOREIGN KEY (respschool_id) REFERENCES resp_school (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64945698AFE FOREIGN KEY (resplevel_id) REFERENCES resp_level (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649D23FE2F9 FOREIGN KEY (respue_id) REFERENCES resp_ue (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64941807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anonymat DROP FOREIGN KEY FK_FC64F1CB944F1A');
        $this->addSql('ALTER TABLE anonymat DROP FOREIGN KEY FK_FC64F1E32B239F');
        $this->addSql('ALTER TABLE anonymat_rattrapage DROP FOREIGN KEY FK_3E2D843DCB944F1A');
        $this->addSql('ALTER TABLE anonymat_rattrapage DROP FOREIGN KEY FK_3E2D843DE32B239F');
        $this->addSql('ALTER TABLE color_scheme DROP FOREIGN KEY FK_9AFD9BB9C32A47EE');
        $this->addSql('ALTER TABLE ec DROP FOREIGN KEY FK_8DE8BDFF62E883B1');
        $this->addSql('ALTER TABLE ec DROP FOREIGN KEY FK_8DE8BDFF41807E1D');
        $this->addSql('ALTER TABLE ee DROP FOREIGN KEY FK_648B18CAB03A8386');
        $this->addSql('ALTER TABLE ee DROP FOREIGN KEY FK_648B18CA67DDCC43');
        $this->addSql('ALTER TABLE field DROP FOREIGN KEY FK_5BF54558C32A47EE');
        $this->addSql('ALTER TABLE level DROP FOREIGN KEY FK_9AEACC13443707B0');
        $this->addSql('ALTER TABLE level_fields DROP FOREIGN KEY FK_75382295FB14BA7');
        $this->addSql('ALTER TABLE level_fields DROP FOREIGN KEY FK_7538229443707B0');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14D3EAB6BC');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14CB944F1A');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1427634BEF');
        $this->addSql('ALTER TABLE note_cc_tp DROP FOREIGN KEY FK_2885A5F9E32B239F');
        $this->addSql('ALTER TABLE note_cc_tp DROP FOREIGN KEY FK_2885A5F9D3EAB6BC');
        $this->addSql('ALTER TABLE note_cc_tp DROP FOREIGN KEY FK_2885A5F9CB944F1A');
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586DB03A8386');
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586D50C2B2F7');
        $this->addSql('ALTER TABLE resp_field DROP FOREIGN KEY FK_A97AB707443707B0');
        $this->addSql('ALTER TABLE resp_field DROP FOREIGN KEY FK_A97AB707B03A8386');
        $this->addSql('ALTER TABLE resp_level DROP FOREIGN KEY FK_68653E4CB03A8386');
        $this->addSql('ALTER TABLE resp_level DROP FOREIGN KEY FK_68653E4C5FB14BA7');
        $this->addSql('ALTER TABLE resp_school DROP FOREIGN KEY FK_2B8192CC32A47EE');
        $this->addSql('ALTER TABLE resp_school DROP FOREIGN KEY FK_2B8192CB03A8386');
        $this->addSql('ALTER TABLE resp_ue DROP FOREIGN KEY FK_639FCBFF62E883B1');
        $this->addSql('ALTER TABLE resp_ue DROP FOREIGN KEY FK_639FCBFFB03A8386');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07B03A8386');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AC32A47EE');
        $this->addSql('ALTER TABLE role_privilege DROP FOREIGN KEY FK_D6D4495BD60322AC');
        $this->addSql('ALTER TABLE role_privilege DROP FOREIGN KEY FK_D6D4495B32FB8AEA');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33443707B0');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF335FB14BA7');
        $this->addSql('ALTER TABLE take_ue DROP FOREIGN KEY FK_AC89C73DCB944F1A');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5B03A8386');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B5FB14BA7');
        $this->addSql('ALTER TABLE ue_field DROP FOREIGN KEY FK_38132BB862E883B1');
        $this->addSql('ALTER TABLE ue_field DROP FOREIGN KEY FK_38132BB8443707B0');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649CB944F1A');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64953C59D72');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6495EEFC6E9');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649D187767F');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64945698AFE');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649D23FE2F9');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64941807E1D');
        $this->addSql('DROP TABLE anonymat');
        $this->addSql('DROP TABLE anonymat_rattrapage');
        $this->addSql('DROP TABLE color_scheme');
        $this->addSql('DROP TABLE ec');
        $this->addSql('DROP TABLE ee');
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE level_fields');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE note_cc_tp');
        $this->addSql('DROP TABLE privilege');
        $this->addSql('DROP TABLE rattrapage');
        $this->addSql('DROP TABLE resp_field');
        $this->addSql('DROP TABLE resp_level');
        $this->addSql('DROP TABLE resp_school');
        $this->addSql('DROP TABLE resp_ue');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_privilege');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE take_ue');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE ue');
        $this->addSql('DROP TABLE ue_field');
        $this->addSql('DROP TABLE `user`');
    }
}
