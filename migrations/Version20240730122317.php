<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240730122317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assistant_respue (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, user_id INT DEFAULT NULL, respue_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, cni VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, INDEX IDX_6C24CB36B03A8386 (created_by_id), UNIQUE INDEX UNIQ_6C24CB36A76ED395 (user_id), INDEX IDX_6C24CB36D23FE2F9 (respue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assistant_respue ADD CONSTRAINT FK_6C24CB36B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE assistant_respue ADD CONSTRAINT FK_6C24CB36A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE assistant_respue ADD CONSTRAINT FK_6C24CB36D23FE2F9 FOREIGN KEY (respue_id) REFERENCES resp_ue (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistant_respue DROP FOREIGN KEY FK_6C24CB36B03A8386');
        $this->addSql('ALTER TABLE assistant_respue DROP FOREIGN KEY FK_6C24CB36A76ED395');
        $this->addSql('ALTER TABLE assistant_respue DROP FOREIGN KEY FK_6C24CB36D23FE2F9');
        $this->addSql('DROP TABLE assistant_respue');
    }
}
