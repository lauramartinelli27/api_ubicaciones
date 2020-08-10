<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200805160351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE localidad (id INT AUTO_INCREMENT NOT NULL, partido_id INT NOT NULL, nombre VARCHAR(100) NOT NULL, INDEX IDX_4F68E01011856EB4 (partido_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partido (id INT AUTO_INCREMENT NOT NULL, provincia_id INT NOT NULL, nombre VARCHAR(100) NOT NULL, INDEX IDX_4E79750B4E7121AF (provincia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provincia (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE localidad ADD CONSTRAINT FK_4F68E01011856EB4 FOREIGN KEY (partido_id) REFERENCES partido (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B4E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE localidad DROP FOREIGN KEY FK_4F68E01011856EB4');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B4E7121AF');
        $this->addSql('DROP TABLE localidad');
        $this->addSql('DROP TABLE partido');
        $this->addSql('DROP TABLE provincia');
    }
}
