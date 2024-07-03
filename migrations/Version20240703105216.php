<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703105216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, hex_value VARCHAR(255) DEFAULT NULL, rgb_value VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE privilege (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE privilege_role (privilege_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_97F8DF5F32FB8AEA (privilege_id), INDEX IDX_97F8DF5FD60322AC (role_id), PRIMARY KEY(privilege_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE privilege_role ADD CONSTRAINT FK_97F8DF5F32FB8AEA FOREIGN KEY (privilege_id) REFERENCES privilege (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE privilege_role ADD CONSTRAINT FK_97F8DF5FD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE field ADD school_id INT DEFAULT NULL, ADD level_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF54558C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF545585FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('CREATE INDEX IDX_5BF54558C32A47EE ON field (school_id)');
        $this->addSql('CREATE INDEX IDX_5BF545585FB14BA7 ON field (level_id)');
        $this->addSql('ALTER TABLE role ADD school_id INT DEFAULT NULL, ADD name VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AC32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('CREATE INDEX IDX_57698A6AC32A47EE ON role (school_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE field DROP FOREIGN KEY FK_5BF54558C32A47EE');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AC32A47EE');
        $this->addSql('ALTER TABLE privilege_role DROP FOREIGN KEY FK_97F8DF5F32FB8AEA');
        $this->addSql('ALTER TABLE privilege_role DROP FOREIGN KEY FK_97F8DF5FD60322AC');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE privilege');
        $this->addSql('DROP TABLE privilege_role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE school');
        $this->addSql('ALTER TABLE field DROP FOREIGN KEY FK_5BF545585FB14BA7');
        $this->addSql('DROP INDEX IDX_5BF54558C32A47EE ON field');
        $this->addSql('DROP INDEX IDX_5BF545585FB14BA7 ON field');
        $this->addSql('ALTER TABLE field DROP school_id, DROP level_id');
        $this->addSql('DROP INDEX IDX_57698A6AC32A47EE ON role');
        $this->addSql('ALTER TABLE role DROP school_id, DROP name, DROP created_at, DROP updated_at');
    }
}
