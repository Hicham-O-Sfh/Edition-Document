<?php

namespace App\Entity;

use App\Repository\PersonnelRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=PersonnelRepository::class)
 * @UniqueEntity(fields={"emailProfessionnel"}, message="There is already an account with this emailProfessionnel")
 */
class Personnel implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $emailProfessionnel;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $numCin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $validiteCin;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomFr;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomAr;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $prenomFr;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $prenomAr;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomConjointAr;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $PrenomConjointAr;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreEnfants;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseFr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseAr;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lieuNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numCnss;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numCimr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telPersonnel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telProfessionnel;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $emailPersonnel;
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEntree;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $situationFamiliale;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $salaire;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $banque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numRib;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateTitularisation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estPersonnel = 1;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $photo = 'user.png';

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=TypeContrat::class, inversedBy="personnels")
     */
    private $typeContrat;

    /**
     * @ORM\OneToMany(targetEntity=PersonnelDiplome::class, mappedBy="personnel")
     */
    private $personnelDiplomes;

    /**
     * @ORM\ManyToOne(targetEntity=Secteur::class, inversedBy="Personnels")
     */
    private $secteur;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $nationalite;

    /**
     * @ORM\OneToMany(targetEntity=PersonnelConge::class, mappedBy="personnel")
     */
    private $personnelConges;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomConjointFr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomConjointFr;

    /**
     * @ORM\OneToMany(targetEntity=PersonnelDocument::class, mappedBy="personnel")
     */
    private $personnelDocuments;

    /**
     * @ORM\OneToMany(targetEntity=PersonnelFonction::class, mappedBy="personnel")
     */
    private $personnelFonctions;

    /**
     * @ORM\OneToMany(targetEntity=PersonnelMission::class, mappedBy="personnel")
     */
    private $personnelMissions;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDepart;

    /**
     * @ORM\ManyToOne(targetEntity=MotifRejet::class, inversedBy="personnels")
     */
    private $motif;

    /**
     * @ORM\OneToMany(targetEntity=MouvementPersonnel::class, mappedBy="personnel")
     */
    private $mouvementPersonnels;

    /**
     * @ORM\OneToMany(targetEntity=PersonnelDocumentExterne::class, mappedBy="personnel")
     */
    private $personnelDocumentExternes;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $utiliseApplication = 1;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estChef;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class, inversedBy="personnels")
     */
    private $chef;

    /**
     * @ORM\OneToMany(targetEntity=Personnel::class, mappedBy="chef")
     */
    private $personnels;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="personnels")
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity=HistoPersonnel::class, mappedBy="personnel")
     */
    private $histoPersonnels;



    public function __construct()
    {
        $this->personnelDiplomes = new ArrayCollection();
        $this->personnelConges = new ArrayCollection();
        $this->personnelDocuments = new ArrayCollection();
        $this->personnelFonctions = new ArrayCollection();
        $this->personnelMissions = new ArrayCollection();
        $this->mouvementPersonnels = new ArrayCollection();
        $this->personnelDocumentExternes = new ArrayCollection();
        $this->personnels = new ArrayCollection();
        $this->histoPersonnels = new ArrayCollection();
    }



    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNumCin(): ?string
    {
        return $this->numCin;
    }

    public function setNumCin(?string $numCin): self
    {
        $this->numCin = $numCin;

        return $this;
    }

    public function getValiditeCin(): ?\DateTimeInterface
    {
        return $this->validiteCin;
    }

    public function setValiditeCin(?\DateTimeInterface $validiteCin): self
    {
        $this->validiteCin = $validiteCin;

        return $this;
    }

    public function getNomFr(): ?string
    {
        return $this->nomFr;
    }

    public function setNomFr(?string $nomFr): self
    {
        $this->nomFr = $nomFr;

        return $this;
    }

    public function getNomAr(): ?string
    {
        return $this->nomAr;
    }

    public function setNomAr(?string $nomAr): self
    {
        $this->nomAr = $nomAr;

        return $this;
    }

    public function getPrenomFr(): ?string
    {
        return $this->prenomFr;
    }

    public function setPrenomFr(?string $prenomFr): self
    {
        $this->prenomFr = $prenomFr;

        return $this;
    }

    public function getPrenomAr(): ?string
    {
        return $this->prenomAr;
    }

    public function setPrenomAr(?string $prenomAr): self
    {
        $this->prenomAr = $prenomAr;

        return $this;
    }

    public function getNomConjointAr(): ?string
    {
        return $this->nomConjointAr;
    }

    public function setNomConjointAr(?string $nomConjointAr): self
    {
        $this->nomConjoinAr = $nomConjointAr;

        return $this;
    }

    public function getPrenomConjointAr(): ?string
    {
        return $this->PrenomConjointAr;
    }

    public function setPrenomConjointAr(?string $PrenomConjointAr): self
    {
        $this->PrenomConjointAr = $PrenomConjointAr;

        return $this;
    }

    public function getNombreEnfants(): ?int
    {
        return $this->nombreEnfants;
    }

    public function setNombreEnfants(?int $nombreEnfants): self
    {
        $this->nombreEnfants = $nombreEnfants;

        return $this;
    }

    public function getAdresseFr(): ?string
    {
        return $this->adresseFr;
    }

    public function setAdresseFr(?string $adresseFr): self
    {
        $this->adresseFr = $adresseFr;

        return $this;
    }

    public function getAdresseAr(): ?string
    {
        return $this->adresseAr;
    }

    public function setAdresseAr(?string $adresseAr): self
    {
        $this->adresseAr = $adresseAr;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(?string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getNumCnss(): ?string
    {
        return $this->numCnss;
    }

    public function setNumCnss(?string $numCnss): self
    {
        $this->numCnss = $numCnss;

        return $this;
    }

    public function getNumCimr(): ?string
    {
        return $this->numCimr;
    }

    public function setNumCimr(?string $numCimr): self
    {
        $this->numCimr = $numCimr;

        return $this;
    }

    public function getTelPersonnel(): ?string
    {
        return $this->telPersonnel;
    }

    public function setTelPersonnel(?string $telPersonnel): self
    {
        $this->telPersonnel = $telPersonnel;

        return $this;
    }

    public function getTelProfessionnel(): ?string
    {
        return $this->telProfessionnel;
    }

    public function setTelProfessionnel(?string $telProfessionnel): self
    {
        $this->telProfessionnel = $telProfessionnel;

        return $this;
    }

    public function getEmailPersonnel(): ?string
    {
        return $this->emailPersonnel;
    }

    public function setEmailPersonnel(?string $emailPersonnel): self
    {
        $this->emailPersonnel = $emailPersonnel;

        return $this;
    }



    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(?\DateTimeInterface $dateEntree): self
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    public function getSituationFamiliale(): ?string
    {
        return $this->situationFamiliale;
    }

    public function setSituationFamiliale(string $situationFamiliale): self
    {
        $this->situationFamiliale = $situationFamiliale;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(?float $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getBanque(): ?string
    {
        return $this->banque;
    }

    public function setBanque(?string $banque): self
    {
        $this->banque = $banque;

        return $this;
    }

    public function getNumRib(): ?string
    {
        return $this->numRib;
    }

    public function setNumRib(?string $numRib): self
    {
        $this->numRib = $numRib;

        return $this;
    }

    public function getDateTitularisation(): ?\DateTimeInterface
    {
        return $this->dateTitularisation;
    }

    public function setDateTitularisation(?\DateTimeInterface $dateTitularisation): self
    {
        $this->dateTitularisation = $dateTitularisation;

        return $this;
    }

    public function getEstPersonnel(): ?bool
    {
        return $this->estPersonnel;
    }

    public function setEstPersonnel(?bool $estPersonnel): self
    {
        $this->estPersonnel = $estPersonnel;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getNomFr() . " " . $this->getPrenomFr();
    }

    public function getTypeContrat(): ?TypeContrat
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?TypeContrat $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    /**
     * @return Collection|PersonnelDiplome[]
     */
    public function getPersonnelDiplomes(): Collection
    {
        return $this->personnelDiplomes;
    }

    public function addPersonnelDiplome(PersonnelDiplome $personnelDiplome): self
    {
        if (!$this->personnelDiplomes->contains($personnelDiplome)) {
            $this->personnelDiplomes[] = $personnelDiplome;
            $personnelDiplome->setPersonnel($this);
        }

        return $this;
    }

    public function removePersonnelDiplome(PersonnelDiplome $personnelDiplome): self
    {
        if ($this->personnelDiplomes->contains($personnelDiplome)) {
            $this->personnelDiplomes->removeElement($personnelDiplome);
            // set the owning side to null (unless already changed)
            if ($personnelDiplome->getPersonnel() === $this) {
                $personnelDiplome->setPersonnel(null);
            }
        }

        return $this;
    }








    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailProfessionnel(): ?string
    {
        return $this->emailProfessionnel;
    }

    public function setEmailProfessionnel(string $emailProfessionnel): self
    {
        $this->emailProfessionnel = $emailProfessionnel;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->emailProfessionnel;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|PersonnelConge[]
     */
    public function getPersonnelConges(): Collection
    {
        return $this->personnelConges;
    }

    public function addPersonnelConge(PersonnelConge $personnelConge): self
    {
        if (!$this->personnelConges->contains($personnelConge)) {
            $this->personnelConges[] = $personnelConge;
            $personnelConge->setPersonnel($this);
        }

        return $this;
    }

    public function removePersonnelConge(PersonnelConge $personnelConge): self
    {
        if ($this->personnelConges->contains($personnelConge)) {
            $this->personnelConges->removeElement($personnelConge);
            // set the owning side to null (unless already changed)
            if ($personnelConge->getPersonnel() === $this) {
                $personnelConge->setPersonnel(null);
            }
        }

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(?string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getNomConjointFr(): ?string
    {
        return $this->nomConjointFr;
    }

    public function setNomConjointFr(?string $nomConjointFr): self
    {
        $this->nomConjointFr = $nomConjointFr;

        return $this;
    }

    public function getPrenomConjointFr(): ?string
    {
        return $this->prenomConjointFr;
    }

    public function setPrenomConjointFr(?string $prenomConjointFr): self
    {
        $this->prenomConjointFr = $prenomConjointFr;

        return $this;
    }

    /**
     * @return Collection|PersonnelDocument[]
     */
    public function getPersonnelDocuments(): Collection
    {
        return $this->personnelDocuments;
    }

    public function addPersonnelDocument(PersonnelDocument $personnelDocument): self
    {
        if (!$this->personnelDocuments->contains($personnelDocument)) {
            $this->personnelDocuments[] = $personnelDocument;
            $personnelDocument->setPersonnel($this);
        }

        return $this;
    }

    public function removePersonnelDocument(PersonnelDocument $personnelDocument): self
    {
        if ($this->personnelDocuments->contains($personnelDocument)) {
            $this->personnelDocuments->removeElement($personnelDocument);
            // set the owning side to null (unless already changed)
            if ($personnelDocument->getPersonnel() === $this) {
                $personnelDocument->setPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PersonnelFonction[]
     */
    public function getPersonnelFonctions(): Collection
    {
        return $this->personnelFonctions;
    }

    public function addPersonnelFonction(PersonnelFonction $personnelFonction): self
    {
        if (!$this->personnelFonctions->contains($personnelFonction)) {
            $this->personnelFonctions[] = $personnelFonction;
            $personnelFonction->setPersonnel($this);
        }

        return $this;
    }

    public function removePersonnelFonction(PersonnelFonction $personnelFonction): self
    {
        if ($this->personnelFonctions->contains($personnelFonction)) {
            $this->personnelFonctions->removeElement($personnelFonction);
            // set the owning side to null (unless already changed)
            if ($personnelFonction->getPersonnel() === $this) {
                $personnelFonction->setPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PersonnelMission[]
     */
    public function getPersonnelMissions(): Collection
    {
        return $this->personnelMissions;
    }

    public function addPersonnelMission(PersonnelMission $personnelMission): self
    {
        if (!$this->personnelMissions->contains($personnelMission)) {
            $this->personnelMissions[] = $personnelMission;
            $personnelMission->setPersonnel($this);
        }

        return $this;
    }

    public function removePersonnelMission(PersonnelMission $personnelMission): self
    {
        if ($this->personnelMissions->contains($personnelMission)) {
            $this->personnelMissions->removeElement($personnelMission);
            // set the owning side to null (unless already changed)
            if ($personnelMission->getPersonnel() === $this) {
                $personnelMission->setPersonnel(null);
            }
        }

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(?\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getMotif(): ?MotifRejet
    {
        return $this->motif;
    }

    public function setMotif(?MotifRejet $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * @return Collection|MouvementPersonnel[]
     */
    public function getMouvementPersonnels(): Collection
    {
        return $this->mouvementPersonnels;
    }

    public function addMouvementPersonnel(MouvementPersonnel $mouvementPersonnel): self
    {
        if (!$this->mouvementPersonnels->contains($mouvementPersonnel)) {
            $this->mouvementPersonnels[] = $mouvementPersonnel;
            $mouvementPersonnel->setPersonnel($this);
        }

        return $this;
    }

    public function removeMouvementPersonnel(MouvementPersonnel $mouvementPersonnel): self
    {
        if ($this->mouvementPersonnels->contains($mouvementPersonnel)) {
            $this->mouvementPersonnels->removeElement($mouvementPersonnel);
            // set the owning side to null (unless already changed)
            if ($mouvementPersonnel->getPersonnel() === $this) {
                $mouvementPersonnel->setPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PersonnelDocumentExterne[]
     */
    public function getPersonnelDocumentExternes(): Collection
    {
        return $this->personnelDocumentExternes;
    }

    public function addPersonnelDocumentExterne(PersonnelDocumentExterne $personnelDocumentExterne): self
    {
        if (!$this->personnelDocumentExternes->contains($personnelDocumentExterne)) {
            $this->personnelDocumentExternes[] = $personnelDocumentExterne;
            $personnelDocumentExterne->setPersonnel($this);
        }

        return $this;
    }

    public function removePersonnelDocumentExterne(PersonnelDocumentExterne $personnelDocumentExterne): self
    {
        if ($this->personnelDocumentExternes->contains($personnelDocumentExterne)) {
            $this->personnelDocumentExternes->removeElement($personnelDocumentExterne);
            // set the owning side to null (unless already changed)
            if ($personnelDocumentExterne->getPersonnel() === $this) {
                $personnelDocumentExterne->setPersonnel(null);
            }
        }

        return $this;
    }

    public function getUtiliseApplication(): ?bool
    {
        return $this->utiliseApplication;
    }

    public function setUtiliseApplication(?bool $utiliseApplication): self
    {
        $this->utiliseApplication = $utiliseApplication;

        return $this;
    }

    public function getEstChef(): ?bool
    {
        return $this->estChef;
    }

    public function setEstChef(?bool $estChef): self
    {
        $this->estChef = $estChef;

        return $this;
    }

    public function getChef(): ?self
    {
        return $this->chef;
    }

    public function setChef(?self $chef): self
    {
        $this->chef = $chef;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getPersonnels(): Collection
    {
        return $this->personnels;
    }

    public function addPersonnel(self $personnel): self
    {
        if (!$this->personnels->contains($personnel)) {
            $this->personnels[] = $personnel;
            $personnel->setChef($this);
        }

        return $this;
    }

    public function removePersonnel(self $personnel): self
    {
        if ($this->personnels->contains($personnel)) {
            $this->personnels->removeElement($personnel);
            // set the owning side to null (unless already changed)
            if ($personnel->getChef() === $this) {
                $personnel->setChef(null);
            }
        }

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|HistoPersonnel[]
     */
    public function getHistoPersonnels(): Collection
    {
        return $this->histoPersonnels;
    }

    public function addHistoPersonnel(HistoPersonnel $histoPersonnel): self
    {
        if (!$this->histoPersonnels->contains($histoPersonnel)) {
            $this->histoPersonnels[] = $histoPersonnel;
            $histoPersonnel->setPersonnel($this);
        }

        return $this;
    }

    public function removeHistoPersonnel(HistoPersonnel $histoPersonnel): self
    {
        if ($this->histoPersonnels->contains($histoPersonnel)) {
            $this->histoPersonnels->removeElement($histoPersonnel);
            // set the owning side to null (unless already changed)
            if ($histoPersonnel->getPersonnel() === $this) {
                $histoPersonnel->setPersonnel(null);
            }
        }

        return $this;
    }
}
