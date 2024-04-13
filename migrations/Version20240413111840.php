<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413111840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert data into resturant, category, and category_to_resurant tables';
    }

    public function up(Schema $schema): void
    {
      $this->addSql("INSERT INTO resturant (id, name, address, telefonnummer) VALUES 
      (1, 'Restaurant Ente', '123 Main St', '123-456-7890'),
      (2, 'Restaurant Huacas Peru - Wiesbaden', '456 Elm St', '456-789-0123'),
      (3, 'Restaurant Mauritius', '456 Elm St', '456-789-0123'),
      (4, 'CHEZ MAMIE Wiesbaden', '456 Elm St', '456-789-0123'),
      (5, 'Restaurant Uhrturm - Wiesbaden', '456 Elm St', '456-789-0123'),
      (6, 'Restaurant Ente 2', '123 Main St', '123-456-7890'),
      (7, 'Restaurant Huacas Peru - Wiesbaden 2', '456 Elm St', '456-789-0123'),
      (8, 'Restaurant Mauritius 2', '456 Elm St', '456-789-0123'),
      (9, 'CHEZ MAMIE Wiesbaden 2', '456 Elm St', '456-789-0123'),
      (10, 'Restaurant Uhrturm - Wiesbaden 2', '456 Elm St', '456-789-0123')");

      $this->addSql("INSERT INTO category (id, name) VALUES 
      (1, 'Casual dining'),
      (2, 'Pop-up restaurant'),
      (3, 'Fast food'),
      (4, 'Food trucks'),
      (5, 'Bistro'),
      (6, 'Diner'),
      (7, 'Beverages'),
      (8, 'Pizzerías')");

      $this->addSql("INSERT INTO category_to_resturant (id, resturant_id, category_id) VALUES 
      (1, 1, 1),
      (2, 2, 2),
      (3, 3, 3),
      (4, 4, 4),
      (5, 5, 5),
      (6, 1, 3),
      (7, 2, 4),
      (8, 3, 5)");

      $this->addSql("INSERT INTO selected_resturant (id, timestamp, resturant) VALUES 
      (1, '2022-04-01 10:00:00', 'Restaurant Ente'),
      (2, '2022-04-02 12:00:00', 'Restaurant Mauritius')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
