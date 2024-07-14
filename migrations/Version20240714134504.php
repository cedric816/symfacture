<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240714134504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document ADD company_info_id INT NOT NULL, ADD customer_info_id INT NOT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A767DD9DB2F FOREIGN KEY (company_info_id) REFERENCES info (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7641566546 FOREIGN KEY (customer_info_id) REFERENCES info (id)');
        $this->addSql('CREATE INDEX IDX_D8698A767DD9DB2F ON document (company_info_id)');
        $this->addSql('CREATE INDEX IDX_D8698A7641566546 ON document (customer_info_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A767DD9DB2F');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7641566546');
        $this->addSql('DROP INDEX IDX_D8698A767DD9DB2F ON document');
        $this->addSql('DROP INDEX IDX_D8698A7641566546 ON document');
        $this->addSql('ALTER TABLE document DROP company_info_id, DROP customer_info_id');
    }
}
