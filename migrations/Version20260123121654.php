<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260123121654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC9F4902B6 FOREIGN KEY (lanterne_id) REFERENCES lanterne (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE lanterne ADD image_name VARCHAR(255) DEFAULT NULL, ADD update_at DATETIME DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE lanterne ADD CONSTRAINT FK_6C206D18A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC9F4902B6');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE lanterne DROP FOREIGN KEY FK_6C206D18A76ED395');
        $this->addSql('ALTER TABLE lanterne ADD image VARCHAR(255) NOT NULL, DROP image_name, DROP update_at');
    }
}
