<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251022212328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE variacao_produtos (id INT AUTO_INCREMENT NOT NULL, produto_id INT NOT NULL, medida_id INT NOT NULL, quantidade DOUBLE PRECISION NOT NULL, INDEX IDX_E7245159105CFD56 (produto_id), INDEX IDX_E7245159F504B72F (medida_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE variacao_produtos ADD CONSTRAINT FK_E7245159105CFD56 FOREIGN KEY (produto_id) REFERENCES produtos (id)');
        $this->addSql('ALTER TABLE variacao_produtos ADD CONSTRAINT FK_E7245159F504B72F FOREIGN KEY (medida_id) REFERENCES medidas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE variacao_produtos DROP FOREIGN KEY FK_E7245159105CFD56');
        $this->addSql('ALTER TABLE variacao_produtos DROP FOREIGN KEY FK_E7245159F504B72F');
        $this->addSql('DROP TABLE variacao_produtos');
    }
}
