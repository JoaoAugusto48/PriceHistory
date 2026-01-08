<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260107030112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE preco_historicos (id INT AUTO_INCREMENT NOT NULL, estabelecimento_id INT NOT NULL, produto_variacao_id INT NOT NULL, marca_id INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, valor NUMERIC(10, 2) NOT NULL, descricao VARCHAR(255) DEFAULT NULL, consultado_em DATE NOT NULL, INDEX IDX_760EE7E94DBB2654 (estabelecimento_id), INDEX IDX_760EE7E953EC9834 (produto_variacao_id), INDEX IDX_760EE7E981EF0041 (marca_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE preco_historicos ADD CONSTRAINT FK_760EE7E94DBB2654 FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimentos (id)');
        $this->addSql('ALTER TABLE preco_historicos ADD CONSTRAINT FK_760EE7E953EC9834 FOREIGN KEY (produto_variacao_id) REFERENCES variacao_produtos (id)');
        $this->addSql('ALTER TABLE preco_historicos ADD CONSTRAINT FK_760EE7E981EF0041 FOREIGN KEY (marca_id) REFERENCES marcas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE preco_historicos DROP FOREIGN KEY FK_760EE7E94DBB2654');
        $this->addSql('ALTER TABLE preco_historicos DROP FOREIGN KEY FK_760EE7E953EC9834');
        $this->addSql('ALTER TABLE preco_historicos DROP FOREIGN KEY FK_760EE7E981EF0041');
        $this->addSql('DROP TABLE preco_historicos');
    }
}
