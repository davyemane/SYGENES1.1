<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704125922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color_scheme (id INT AUTO_INCREMENT NOT NULL, school_id INT DEFAULT NULL, primary_color VARCHAR(255) DEFAULT NULL, secondary_color VARCHAR(255) DEFAULT NULL, accent_color VARCHAR(255) DEFAULT NULL, bacground_color VARCHAR(255) DEFAULT NULL, text_color VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_9AFD9BB9C32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level_fields (level_id INT NOT NULL, field_id INT NOT NULL, INDEX IDX_75382295FB14BA7 (level_id), INDEX IDX_7538229443707B0 (field_id), PRIMARY KEY(level_id, field_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE privilege (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE privilege_role (privilege_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_97F8DF5F32FB8AEA (privilege_id), INDEX IDX_97F8DF5FD60322AC (role_id), PRIMARY KEY(privilege_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE color_scheme ADD CONSTRAINT FK_9AFD9BB9C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE level_fields ADD CONSTRAINT FK_75382295FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE level_fields ADD CONSTRAINT FK_7538229443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE privilege_role ADD CONSTRAINT FK_97F8DF5F32FB8AEA FOREIGN KEY (privilege_id) REFERENCES privilege (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE privilege_role ADD CONSTRAINT FK_97F8DF5FD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B443707B0');
        $this->addSql('ALTER TABLE field_ue DROP FOREIGN KEY FK_D5476A7B62E883B1');
        $this->addSql('DROP TABLE field_ue');
        $this->addSql('ALTER TABLE field ADD school_id INT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF54558C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('CREATE INDEX IDX_5BF54558C32A47EE ON field (school_id)');
        $this->addSql('ALTER TABLE level ADD field_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE level ADD CONSTRAINT FK_9AEACC13443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('CREATE INDEX IDX_9AEACC13443707B0 ON level (field_id)');
        $this->addSql('ALTER TABLE role ADD school_id INT DEFAULT NULL, ADD name VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AC32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('CREATE INDEX IDX_57698A6AC32A47EE ON role (school_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE field DROP FOREIGN KEY FK_5BF54558C32A47EE');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AC32A47EE');
        $this->addSql('CREATE TABLE field_ue (field_id INT NOT NULL, ue_id INT NOT NULL, INDEX IDX_D5476A7B62E883B1 (ue_id), INDEX IDX_D5476A7B443707B0 (field_id), PRIMARY KEY(field_id, ue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE field_ue ADD CONSTRAINT FK_D5476A7B62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE color_scheme DROP FOREIGN KEY FK_9AFD9BB9C32A47EE');
        $this->addSql('ALTER TABLE level_fields DROP FOREIGN KEY FK_75382295FB14BA7');
        $this->addSql('ALTER TABLE level_fields DROP FOREIGN KEY FK_7538229443707B0');
        $this->addSql('ALTER TABLE privilege_role DROP FOREIGN KEY FK_97F8DF5F32FB8AEA');
        $this->addSql('ALTER TABLE privilege_role DROP FOREIGN KEY FK_97F8DF5FD60322AC');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('DROP TABLE color_scheme');
        $this->addSql('DROP TABLE level_fields');
        $this->addSql('DROP TABLE privilege');
        $this->addSql('DROP TABLE privilege_role');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP INDEX IDX_5BF54558C32A47EE ON field');
        $this->addSql('ALTER TABLE field DROP school_id, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE level DROP FOREIGN KEY FK_9AEACC13443707B0');
        $this->addSql('DROP INDEX IDX_9AEACC13443707B0 ON level');
        $this->addSql('ALTER TABLE level DROP field_id');
        $this->addSql('DROP INDEX IDX_57698A6AC32A47EE ON role');
        $this->addSql('ALTER TABLE role DROP school_id, DROP name, DROP created_at, DROP updated_at');
    }
}
