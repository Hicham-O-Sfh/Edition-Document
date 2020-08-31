<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831203538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, province_id INT DEFAULT NULL, commune_ar VARCHAR(255) DEFAULT NULL, commune_fr VARCHAR(255) DEFAULT NULL, INDEX IDX_E2E2D1EEE946114A (province_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordonnees_anoc (id INT AUTO_INCREMENT NOT NULL, property VARCHAR(255) DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, observation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, chef_departement_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C1765B63C8805231 (chef_departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplome (id INT AUTO_INCREMENT NOT NULL, libelle_fr VARCHAR(255) DEFAULT NULL, libelle_ar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_externe (id INT AUTO_INCREMENT NOT NULL, libelle_fr VARCHAR(255) DEFAULT NULL, libelle_ar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, libelle_fr VARCHAR(255) DEFAULT NULL, libelle_ar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE histo_personnel (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, property VARCHAR(255) DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, INDEX IDX_931B08601C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_affectation (id INT AUTO_INCREMENT NOT NULL, libelle_fr VARCHAR(255) DEFAULT NULL, libelle_ar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_document (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) DEFAULT NULL, date_creation DATE DEFAULT NULL, details VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motif_rejet (id INT AUTO_INCREMENT NOT NULL, libelle_ar VARCHAR(255) DEFAULT NULL, libelle_fr VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mouvement_personnel (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, lieu_affectation_id INT DEFAULT NULL, date_affectation DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, observation LONGTEXT DEFAULT NULL, decision VARCHAR(255) DEFAULT NULL, num_decision VARCHAR(255) DEFAULT NULL, date_decision DATE DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, typeaffectation VARCHAR(255) DEFAULT NULL, duree VARCHAR(255) DEFAULT NULL, INDEX IDX_55869ED31C109075 (personnel_id), INDEX IDX_55869ED3A51A24E (lieu_affectation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nature_conge (id INT AUTO_INCREMENT NOT NULL, libelle_fr VARCHAR(255) DEFAULT NULL, libelle_ar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, type_contrat_id INT DEFAULT NULL, secteur_id INT DEFAULT NULL, motif_id INT DEFAULT NULL, chef_id INT DEFAULT NULL, departement_id INT DEFAULT NULL, email_professionnel VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, matricule VARCHAR(255) DEFAULT NULL, num_cin VARCHAR(20) DEFAULT NULL, validite_cin DATE DEFAULT NULL, nom_fr VARCHAR(50) DEFAULT NULL, nom_ar VARCHAR(50) DEFAULT NULL, prenom_fr VARCHAR(50) DEFAULT NULL, prenom_ar VARCHAR(50) DEFAULT NULL, nom_conjoint_ar VARCHAR(50) DEFAULT NULL, prenom_conjoint_ar VARCHAR(50) DEFAULT NULL, nombre_enfants INT DEFAULT NULL, adresse_fr VARCHAR(255) DEFAULT NULL, adresse_ar VARCHAR(255) DEFAULT NULL, sexe VARCHAR(20) DEFAULT NULL, date_naissance DATE DEFAULT NULL, lieu_naissance VARCHAR(50) DEFAULT NULL, num_cnss VARCHAR(255) DEFAULT NULL, num_cimr VARCHAR(255) DEFAULT NULL, tel_personnel VARCHAR(255) DEFAULT NULL, tel_professionnel VARCHAR(255) DEFAULT NULL, email_personnel VARCHAR(80) DEFAULT NULL, date_entree DATE DEFAULT NULL, situation_familiale VARCHAR(50) DEFAULT NULL, salaire DOUBLE PRECISION DEFAULT NULL, banque VARCHAR(100) DEFAULT NULL, num_rib VARCHAR(255) DEFAULT NULL, date_titularisation DATE DEFAULT NULL, est_personnel TINYINT(1) DEFAULT NULL, photo VARCHAR(500) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(500) DEFAULT NULL, nom_conjoint_fr VARCHAR(255) DEFAULT NULL, prenom_conjoint_fr VARCHAR(255) DEFAULT NULL, date_depart DATE DEFAULT NULL, utilise_application TINYINT(1) DEFAULT NULL, est_chef TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_A6BCF3DE881FD2A7 (email_professionnel), INDEX IDX_A6BCF3DE520D03A (type_contrat_id), INDEX IDX_A6BCF3DE9F7E4405 (secteur_id), INDEX IDX_A6BCF3DED0EEB819 (motif_id), INDEX IDX_A6BCF3DE150A48F1 (chef_id), INDEX IDX_A6BCF3DECCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_conge (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, nature_conge_id INT DEFAULT NULL, date_demande_conge DATE DEFAULT NULL, date_debut_conge DATE DEFAULT NULL, date_fin_conge DATE DEFAULT NULL, decision_de_chef VARCHAR(255) DEFAULT NULL, date_decision_chef DATE DEFAULT NULL, observation_decision_chef VARCHAR(255) DEFAULT NULL, motif_rejet VARCHAR(255) DEFAULT NULL, INDEX IDX_911F8F61C109075 (personnel_id), INDEX IDX_911F8F63C0D3F49 (nature_conge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_diplome (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, diplome_id INT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, date_obtention DATE DEFAULT NULL, etablissement VARCHAR(255) DEFAULT NULL, specialite VARCHAR(255) DEFAULT NULL, chemin_doc VARCHAR(255) DEFAULT NULL, INDEX IDX_4B6A51611C109075 (personnel_id), INDEX IDX_4B6A516126F859E2 (diplome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_document (id INT AUTO_INCREMENT NOT NULL, model_document_id INT DEFAULT NULL, personnel_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, date_obtention DATE DEFAULT NULL, date_demande DATE DEFAULT NULL, observation LONGTEXT DEFAULT NULL, INDEX IDX_73189133AD3D41DB (model_document_id), INDEX IDX_731891331C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_document_externe (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, document_externe_id INT DEFAULT NULL, date_creation DATE DEFAULT NULL, chemin_doc VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, INDEX IDX_55A8CFEC1C109075 (personnel_id), INDEX IDX_55A8CFEC3A78EF04 (document_externe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_fonction (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, fonction_id INT DEFAULT NULL, lieu_affectation_id INT DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, observation LONGTEXT DEFAULT NULL, INDEX IDX_A271CEF81C109075 (personnel_id), INDEX IDX_A271CEF857889920 (fonction_id), INDEX IDX_A271CEF8A51A24E (lieu_affectation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_mission (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, destination VARCHAR(255) DEFAULT NULL, moyen_transport VARCHAR(255) DEFAULT NULL, date_depart DATE DEFAULT NULL, date_retour DATE DEFAULT NULL, observation LONGTEXT DEFAULT NULL, decision_chef VARCHAR(255) DEFAULT NULL, date_decision_chef DATE DEFAULT NULL, observation_decision_chef VARCHAR(255) DEFAULT NULL, motif_annulation VARCHAR(255) DEFAULT NULL, libele_mission_fr VARCHAR(255) DEFAULT NULL, libele_mission_ar VARCHAR(255) DEFAULT NULL, INDEX IDX_3041EE131C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE province (id INT AUTO_INCREMENT NOT NULL, region_id INT DEFAULT NULL, province_ar VARCHAR(255) DEFAULT NULL, province_fr VARCHAR(255) DEFAULT NULL, INDEX IDX_4ADAD40B98260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, region_fr VARCHAR(255) DEFAULT NULL, region_ar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, animateur_id INT DEFAULT NULL, libelle_fr VARCHAR(255) DEFAULT NULL, libelle_ar VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, email1 VARCHAR(255) DEFAULT NULL, email2 VARCHAR(255) DEFAULT NULL, fixe1 VARCHAR(255) DEFAULT NULL, fixe2 VARCHAR(255) DEFAULT NULL, gsm1 VARCHAR(255) DEFAULT NULL, gsm2 VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8045251F7F05C301 (animateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_contrat (id INT AUTO_INCREMENT NOT NULL, libelle_fr VARCHAR(255) DEFAULT NULL, libelle_ar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEE946114A FOREIGN KEY (province_id) REFERENCES province (id)');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63C8805231 FOREIGN KEY (chef_departement_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE histo_personnel ADD CONSTRAINT FK_931B08601C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE mouvement_personnel ADD CONSTRAINT FK_55869ED31C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE mouvement_personnel ADD CONSTRAINT FK_55869ED3A51A24E FOREIGN KEY (lieu_affectation_id) REFERENCES list_affectation (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE9F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DED0EEB819 FOREIGN KEY (motif_id) REFERENCES motif_rejet (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE150A48F1 FOREIGN KEY (chef_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DECCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE personnel_conge ADD CONSTRAINT FK_911F8F61C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE personnel_conge ADD CONSTRAINT FK_911F8F63C0D3F49 FOREIGN KEY (nature_conge_id) REFERENCES nature_conge (id)');
        $this->addSql('ALTER TABLE personnel_diplome ADD CONSTRAINT FK_4B6A51611C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE personnel_diplome ADD CONSTRAINT FK_4B6A516126F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE personnel_document ADD CONSTRAINT FK_73189133AD3D41DB FOREIGN KEY (model_document_id) REFERENCES model_document (id)');
        $this->addSql('ALTER TABLE personnel_document ADD CONSTRAINT FK_731891331C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE personnel_document_externe ADD CONSTRAINT FK_55A8CFEC1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE personnel_document_externe ADD CONSTRAINT FK_55A8CFEC3A78EF04 FOREIGN KEY (document_externe_id) REFERENCES document_externe (id)');
        $this->addSql('ALTER TABLE personnel_fonction ADD CONSTRAINT FK_A271CEF81C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE personnel_fonction ADD CONSTRAINT FK_A271CEF857889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id)');
        $this->addSql('ALTER TABLE personnel_fonction ADD CONSTRAINT FK_A271CEF8A51A24E FOREIGN KEY (lieu_affectation_id) REFERENCES list_affectation (id)');
        $this->addSql('ALTER TABLE personnel_mission ADD CONSTRAINT FK_3041EE131C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE province ADD CONSTRAINT FK_4ADAD40B98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE secteur ADD CONSTRAINT FK_8045251F7F05C301 FOREIGN KEY (animateur_id) REFERENCES personnel (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DECCF9E01E');
        $this->addSql('ALTER TABLE personnel_diplome DROP FOREIGN KEY FK_4B6A516126F859E2');
        $this->addSql('ALTER TABLE personnel_document_externe DROP FOREIGN KEY FK_55A8CFEC3A78EF04');
        $this->addSql('ALTER TABLE personnel_fonction DROP FOREIGN KEY FK_A271CEF857889920');
        $this->addSql('ALTER TABLE mouvement_personnel DROP FOREIGN KEY FK_55869ED3A51A24E');
        $this->addSql('ALTER TABLE personnel_fonction DROP FOREIGN KEY FK_A271CEF8A51A24E');
        $this->addSql('ALTER TABLE personnel_document DROP FOREIGN KEY FK_73189133AD3D41DB');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DED0EEB819');
        $this->addSql('ALTER TABLE personnel_conge DROP FOREIGN KEY FK_911F8F63C0D3F49');
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B63C8805231');
        $this->addSql('ALTER TABLE histo_personnel DROP FOREIGN KEY FK_931B08601C109075');
        $this->addSql('ALTER TABLE mouvement_personnel DROP FOREIGN KEY FK_55869ED31C109075');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE150A48F1');
        $this->addSql('ALTER TABLE personnel_conge DROP FOREIGN KEY FK_911F8F61C109075');
        $this->addSql('ALTER TABLE personnel_diplome DROP FOREIGN KEY FK_4B6A51611C109075');
        $this->addSql('ALTER TABLE personnel_document DROP FOREIGN KEY FK_731891331C109075');
        $this->addSql('ALTER TABLE personnel_document_externe DROP FOREIGN KEY FK_55A8CFEC1C109075');
        $this->addSql('ALTER TABLE personnel_fonction DROP FOREIGN KEY FK_A271CEF81C109075');
        $this->addSql('ALTER TABLE personnel_mission DROP FOREIGN KEY FK_3041EE131C109075');
        $this->addSql('ALTER TABLE secteur DROP FOREIGN KEY FK_8045251F7F05C301');
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EEE946114A');
        $this->addSql('ALTER TABLE province DROP FOREIGN KEY FK_4ADAD40B98260155');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE9F7E4405');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE520D03A');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE coordonnees_anoc');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('DROP TABLE document_externe');
        $this->addSql('DROP TABLE document_type');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE histo_personnel');
        $this->addSql('DROP TABLE list_affectation');
        $this->addSql('DROP TABLE model_document');
        $this->addSql('DROP TABLE motif_rejet');
        $this->addSql('DROP TABLE mouvement_personnel');
        $this->addSql('DROP TABLE nature_conge');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE personnel_conge');
        $this->addSql('DROP TABLE personnel_diplome');
        $this->addSql('DROP TABLE personnel_document');
        $this->addSql('DROP TABLE personnel_document_externe');
        $this->addSql('DROP TABLE personnel_fonction');
        $this->addSql('DROP TABLE personnel_mission');
        $this->addSql('DROP TABLE province');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE type_contrat');
    }
}
