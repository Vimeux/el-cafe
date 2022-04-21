<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421114921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coffee_seed_type (coffee_id INT NOT NULL, seed_type_id INT NOT NULL, INDEX IDX_E5F7660B78CD6D6E (coffee_id), INDEX IDX_E5F7660BEBE5020A (seed_type_id), PRIMARY KEY(coffee_id, seed_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coffee_shop_coffee (coffee_shop_id INT NOT NULL, coffee_id INT NOT NULL, INDEX IDX_3DC8387FACCB8DB (coffee_shop_id), INDEX IDX_3DC8387F78CD6D6E (coffee_id), PRIMARY KEY(coffee_shop_id, coffee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_coffee (user_id INT NOT NULL, coffee_id INT NOT NULL, INDEX IDX_36D7328EA76ED395 (user_id), INDEX IDX_36D7328E78CD6D6E (coffee_id), PRIMARY KEY(user_id, coffee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coffee_seed_type ADD CONSTRAINT FK_E5F7660B78CD6D6E FOREIGN KEY (coffee_id) REFERENCES coffee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coffee_seed_type ADD CONSTRAINT FK_E5F7660BEBE5020A FOREIGN KEY (seed_type_id) REFERENCES seed_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coffee_shop_coffee ADD CONSTRAINT FK_3DC8387FACCB8DB FOREIGN KEY (coffee_shop_id) REFERENCES coffee_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coffee_shop_coffee ADD CONSTRAINT FK_3DC8387F78CD6D6E FOREIGN KEY (coffee_id) REFERENCES coffee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_coffee ADD CONSTRAINT FK_36D7328EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_coffee ADD CONSTRAINT FK_36D7328E78CD6D6E FOREIGN KEY (coffee_id) REFERENCES coffee (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coffee_seed_type');
        $this->addSql('DROP TABLE coffee_shop_coffee');
        $this->addSql('DROP TABLE user_coffee');
    }
}
