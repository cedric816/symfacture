<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240715083420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_company (customer_id INT NOT NULL, company_id INT NOT NULL, INDEX IDX_5362ADF19395C3F3 (customer_id), INDEX IDX_5362ADF1979B1AD6 (company_id), PRIMARY KEY(customer_id, company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer_company ADD CONSTRAINT FK_5362ADF19395C3F3 FOREIGN KEY (customer_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_company ADD CONSTRAINT FK_5362ADF1979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_company DROP FOREIGN KEY FK_5362ADF19395C3F3');
        $this->addSql('ALTER TABLE customer_company DROP FOREIGN KEY FK_5362ADF1979B1AD6');
        $this->addSql('DROP TABLE customer_company');
    }
}
