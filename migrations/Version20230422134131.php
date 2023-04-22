<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230422134131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) DEFAULT NULL, role VARCHAR(255) NOT NULL, email VARCHAR(100) NOT NULL, admin TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_has_people DROP FOREIGN KEY fk_Movie_has_People_People1');
        $this->addSql('ALTER TABLE movie_has_people DROP role, DROP significance');
        $this->addSql('DROP INDEX fk_movie_has_people_people1 ON movie_has_people');
        $this->addSql('CREATE INDEX IDX_EDC40D81B3B64B95 ON movie_has_people (People_id)');
        $this->addSql('ALTER TABLE movie_has_people ADD CONSTRAINT fk_Movie_has_People_People1 FOREIGN KEY (People_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE movie_has_type DROP FOREIGN KEY fk_Movie_has_Type_Type1');
        $this->addSql('DROP INDEX fk_movie_has_type_type1 ON movie_has_type');
        $this->addSql('CREATE INDEX IDX_D7417FBAF1B50F ON movie_has_type (Type_id)');
        $this->addSql('ALTER TABLE movie_has_type ADD CONSTRAINT fk_Movie_has_Type_Type1 FOREIGN KEY (Type_id) REFERENCES type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE movie_has_people DROP FOREIGN KEY FK_EDC40D81B3B64B95');
        $this->addSql('ALTER TABLE movie_has_people ADD role VARCHAR(255) NOT NULL, ADD significance VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX idx_edc40d81b3b64b95 ON movie_has_people');
        $this->addSql('CREATE INDEX fk_Movie_has_People_People1 ON movie_has_people (People_id)');
        $this->addSql('ALTER TABLE movie_has_people ADD CONSTRAINT FK_EDC40D81B3B64B95 FOREIGN KEY (People_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE movie_has_type DROP FOREIGN KEY FK_D7417FBAF1B50F');
        $this->addSql('DROP INDEX idx_d7417fbaf1b50f ON movie_has_type');
        $this->addSql('CREATE INDEX fk_Movie_has_Type_Type1 ON movie_has_type (Type_id)');
        $this->addSql('ALTER TABLE movie_has_type ADD CONSTRAINT FK_D7417FBAF1B50F FOREIGN KEY (Type_id) REFERENCES type (id)');
    }
}
