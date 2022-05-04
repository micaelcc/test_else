<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504013037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "events_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "talks_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE talks DROP CONSTRAINT FK_472281DAD04A0F27');
        $this->addSql('ALTER TABLE talks ADD CONSTRAINT FK_472281DAD04A0F27 FOREIGN KEY (speaker_id) REFERENCES "speakers" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "events_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "talks_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "talks" DROP CONSTRAINT fk_472281dad04a0f27');
        $this->addSql('ALTER TABLE "talks" ADD CONSTRAINT fk_472281dad04a0f27 FOREIGN KEY (speaker_id) REFERENCES speakers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
