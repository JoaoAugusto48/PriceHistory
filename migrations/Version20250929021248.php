<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250929021248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medidas (id INT AUTO_INCREMENT NOT NULL, medida_base_id INT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, name VARCHAR(255) NOT NULL, sigla VARCHAR(255) NOT NULL, fator_conversao DOUBLE PRECISION NOT NULL, INDEX IDX_FF9C1C2A1294C08A (medida_base_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medidas ADD CONSTRAINT FK_FF9C1C2A1294C08A FOREIGN KEY (medida_base_id) REFERENCES medidas (id)');
        $this->addSql('ALTER TABLE sub_categorias RENAME INDEX idx_725410a17e735794 TO IDX_725410A13397707A');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medidas DROP FOREIGN KEY FK_FF9C1C2A1294C08A');
        $this->addSql('DROP TABLE medidas');
        $this->addSql('ALTER TABLE sub_categorias RENAME INDEX idx_725410a13397707a TO IDX_725410A17E735794');
    }
}
