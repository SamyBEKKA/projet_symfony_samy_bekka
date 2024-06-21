<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521143640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE img_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, image_one VARCHAR(255) DEFAULT NULL, image_two VARCHAR(255) DEFAULT NULL, image_three VARCHAR(255) DEFAULT NULL, image_four VARCHAR(255) DEFAULT NULL, image_five VARCHAR(255) DEFAULT NULL, image_six VARCHAR(255) DEFAULT NULL, INDEX IDX_64CAA8CFF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE img_produit ADD CONSTRAINT FK_64CAA8CFF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE img_produit DROP FOREIGN KEY FK_64CAA8CFF347EFB');
        $this->addSql('DROP TABLE img_produit');
    }
}
