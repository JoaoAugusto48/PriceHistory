<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250911024408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sub_categorias (id INT AUTO_INCREMENT NOT NULL, categoria_id INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_725410A17E735794 (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sub_categorias ADD CONSTRAINT FK_725410A17E735794 FOREIGN KEY (categoria_id) REFERENCES categorias (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sub_categorias DROP FOREIGN KEY FK_725410A17E735794');
        $this->addSql('DROP TABLE sub_categorias');
    }
}
