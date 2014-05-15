<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120320180343 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("CREATE TABLE planetflow3_domain_model_user (flow3_persistence_identifier VARCHAR(40) NOT NULL, emailaddress VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, PRIMARY KEY(flow3_persistence_identifier)) ENGINE = InnoDB");
		$this->addSql("ALTER TABLE planetflow3_domain_model_user ADD CONSTRAINT FK_F71D945421E3D446 FOREIGN KEY (flow3_persistence_identifier) REFERENCES typo3_party_domain_model_abstractparty (flow3_persistence_identifier) ON DELETE CASCADE");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("DROP TABLE planetflow3_domain_model_user");
	}
}

?>