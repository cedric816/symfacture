<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240715092844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE professional_customer (professional_id INT NOT NULL, customer_id INT NOT NULL, INDEX IDX_12BF54B4DB77003 (professional_id), INDEX IDX_12BF54B49395C3F3 (customer_id), PRIMARY KEY(professional_id, customer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE professional_customer ADD CONSTRAINT FK_12BF54B4DB77003 FOREIGN KEY (professional_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professional_customer ADD CONSTRAINT FK_12BF54B49395C3F3 FOREIGN KEY (customer_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professional_customer DROP FOREIGN KEY FK_12BF54B4DB77003');
        $this->addSql('ALTER TABLE professional_customer DROP FOREIGN KEY FK_12BF54B49395C3F3');
        $this->addSql('DROP TABLE professional_customer');
    }
}
