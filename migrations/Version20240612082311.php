<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240612082311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ec (id INT AUTO_INCREMENT NOT NULL, ue_id INT DEFAULT NULL, code_ec VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, credit INT DEFAULT NULL, INDEX IDX_8DE8BDFF62E883B1 (ue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE field (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, createb_by_id INT DEFAULT NULL, student_id INT DEFAULT NULL, ec_id INT DEFAULT NULL, cc VARCHAR(255) DEFAULT NULL, tp VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, rattrapage VARCHAR(255) DEFAULT NULL, created_at VARCHAR(255) DEFAULT NULL, semester VARCHAR(10) DEFAULT NULL, INDEX IDX_CFBDFA14D3EAB6BC (createb_by_id), INDEX IDX_CFBDFA14CB944F1A (student_id), INDEX IDX_CFBDFA1427634BEF (ec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at VARCHAR(50) DEFAULT NULL, INDEX IDX_52520D07B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, field_id INT DEFAULT NULL, level_id INT DEFAULT NULL, student_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, date_of_birth DATE DEFAULT NULL, place_of_birth LONGTEXT DEFAULT NULL, birth_certificate VARCHAR(255) DEFAULT NULL, admission_certificate VARCHAR(255) DEFAULT NULL, INDEX IDX_B723AF33443707B0 (field_id), INDEX IDX_B723AF335FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE take_ue (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, grade VARCHAR(50) DEFAULT NULL, semester INT DEFAULT NULL, ue VARCHAR(255) DEFAULT NULL, INDEX IDX_AC89C73DCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, level_id INT DEFAULT NULL, code_ue VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, credit INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, semester VARCHAR(255) DEFAULT NULL, INDEX IDX_2E490A9B5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ec ADD CONSTRAINT FK_8DE8BDFF62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14D3EAB6BC FOREIGN KEY (createb_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1427634BEF FOREIGN KEY (ec_id) REFERENCES ec (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF335FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE take_ue ADD CONSTRAINT FK_AC89C73DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role ADD role VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD student_id INT DEFAULT NULL, ADD responsable_id INT DEFAULT NULL, ADD email VARCHAR(255) DEFAULT NULL, ADD profile_picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64953C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649CB944F1A ON user (student_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64953C59D72 ON user (responsable_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B443707B0');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64953C59D72');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649CB944F1A');
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B62E883B1');
        $this->addSql('ALTER TABLE ec DROP FOREIGN KEY FK_8DE8BDFF62E883B1');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14D3EAB6BC');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14CB944F1A');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1427634BEF');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07B03A8386');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33443707B0');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF335FB14BA7');
        $this->addSql('ALTER TABLE take_ue DROP FOREIGN KEY FK_AC89C73DCB944F1A');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B5FB14BA7');
        $this->addSql('DROP TABLE ec');
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE take_ue');
        $this->addSql('DROP TABLE ue');
        $this->addSql('ALTER TABLE role DROP role');
        $this->addSql('DROP INDEX UNIQ_8D93D649CB944F1A ON `user`');
        $this->addSql('DROP INDEX UNIQ_8D93D64953C59D72 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP student_id, DROP responsable_id, DROP email, DROP profile_picture');
    }
}
