<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525141448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, habitat_id INT DEFAULT NULL, regime_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, date_creation DATETIME NOT NULL, INDEX IDX_6AAB231FAFFE2D26 (habitat_id), INDEX IDX_6AAB231F35E7D534 (regime_id), INDEX IDX_6AAB231FBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, texte VARCHAR(1000) NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_67F068BC8E962C16 (animal_id), INDEX IDX_67F068BCFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, valeur INT NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regime_alimentaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F35E7D534 FOREIGN KEY (regime_id) REFERENCES regime_alimentaire (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FAFFE2D26');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F35E7D534');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FBCF5E72D');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8E962C16');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFB88E14F');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE habitat');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE regime_alimentaire');
        $this->addSql('DROP TABLE utilisateur');
    }
}
