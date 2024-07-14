<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240714093830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, street VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD delivery_address_id INT DEFAULT NULL, ADD billing_address_id INT DEFAULT NULL, ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EBF23851 FOREIGN KEY (delivery_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64979D0C0E4 FOREIGN KEY (billing_address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649EBF23851 ON user (delivery_address_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64979D0C0E4 ON user (billing_address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649EBF23851');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64979D0C0E4');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP INDEX IDX_8D93D649EBF23851 ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D64979D0C0E4 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP delivery_address_id, DROP billing_address_id, DROP type');
    }
}
