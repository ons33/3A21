<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251008103005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, auhtor_id INT NOT NULL, title VARCHAR(255) NOT NULL, publication_date VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_CBE5A331221FC741 (auhtor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reader (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reader_book (reader_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_2A3845F31717D737 (reader_id), INDEX IDX_2A3845F316A2B381 (book_id), PRIMARY KEY(reader_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331221FC741 FOREIGN KEY (auhtor_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE reader_book ADD CONSTRAINT FK_2A3845F31717D737 FOREIGN KEY (reader_id) REFERENCES reader (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reader_book ADD CONSTRAINT FK_2A3845F316A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE author ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C8CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BDAFD8C8CB944F1A ON author (student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331221FC741');
        $this->addSql('ALTER TABLE reader_book DROP FOREIGN KEY FK_2A3845F31717D737');
        $this->addSql('ALTER TABLE reader_book DROP FOREIGN KEY FK_2A3845F316A2B381');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE reader');
        $this->addSql('DROP TABLE reader_book');
        $this->addSql('ALTER TABLE author DROP FOREIGN KEY FK_BDAFD8C8CB944F1A');
        $this->addSql('DROP INDEX UNIQ_BDAFD8C8CB944F1A ON author');
        $this->addSql('ALTER TABLE author DROP student_id');
    }
}
