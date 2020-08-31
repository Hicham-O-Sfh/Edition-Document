<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Entity\Diplome;
use App\Entity\Fonction;
use App\Entity\HistoPersonnel;
use App\Entity\ListAffectation;
use App\Entity\Personnel;
use App\Entity\PersonnelDiplome;
use App\Entity\PersonnelDocumentExterne;
use App\Entity\PersonnelFonction;
use App\Entity\Secteur;
use App\Form\DiplomeType;
use App\Form\PersonnelType;
use App\Repository\ListAffectationRepository;
use App\Repository\MouvementPersonnelRepository;
use App\Repository\PersonnelFonctionRepository;
use App\Repository\PersonnelRepository;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * @Route("/personnel")
 */
class PersonnelController extends AbstractController
{
    /**
     * @Route("/", name="personnel_index", methods={"GET"})
     */
    public function index(PersonnelRepository $personnelRepository): Response
    {

        //dump($personnelRepository->find(1)->getPersonnelMissions());die();
        return $this->render('personnel/index.html.twig', [
            'personnels' => $personnelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/profile", name="personnel_profile", methods={"GET"})
     */
    public function profile(PersonnelRepository $personnelRepository): Response
    {
        return $this->render('personnel/profile.html.twig', [
            'profil' => $personnelRepository->find($this->getUser()->getId()),
        ]);
    }

    /**
     * @Route("/new", name="personnel_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $up): Response
    {
        $personnel = new Personnel();
        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();

        $chefs = $entityManager->getRepository(Personnel::class)->findBy(['estChef' => true]);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();


            $secteur = $request->request->get("personnel")["secteur"];
            $fonction = $request->request->get("personnel")["fonctions"];
            $affectation = $request->request->get("personnel")["affectations"];
            $departement = $request->request->get("personnel")["departement"];
// recuperation du fonction et affectation choisis
            $fonction = $entityManager->getRepository(Fonction::class)->find($fonction);
            $affectation = $entityManager->getRepository(ListAffectation::class)->find($affectation);

            //si il a choisi le secteur
            if ($secteur && ($secteur != "1")) {


                //recuperation de secteur
                $secteur = $entityManager->getRepository(Secteur::class)->find($secteur);

                //affectation du personnel dans le secteur
                $personnel->setSecteur($secteur);
                // si le personnel est un animateur
                if ($fonction->getLibelleFr() == "Animateur") {
                    $personnel->setEstChef(true);
                    $secteur->setAnimateur($personnel);

                }else{
                    if ($secteur->getAnimateur()){
                                    // this permet de ajouter le chef actuelle de secteur a personnel
                        $personnel->setChef($secteur->getAnimateur());

                    }

                }

            } elseif($departement && ($departement != "1")){


                 // le cas ou il a pas choisis secteur (alors departement )
                $departement = $entityManager->getRepository(Departement::class)->find($departement);

                $personnel->setDepartement($departement);

                // manque le traitement de si le personnel est chef deartement !!!!
                if ($fonction->getLibelleFr() == "Chef de département") {
                    $personnel->setEstChef(true);
                    $departement->setChefDepartement($personnel);

                }else{

                    // en affect le chef de departement au personnel

                    if ($departement->getChefDepartement()){

                        $personnel->setChef($departement->getChefDepartement());

                    }


                }

            }
            $personnelFonction = new PersonnelFonction();
            $personnelFonction->setPersonnel($personnel);
          //  $personnelFonction->setDateDebut();
            //on ajout le lieu daffectation
            $personnelFonction->setLieuAffectation($affectation);
            $personnelFonction->setFonction($fonction);


           // $chefs = $entityManager->getRepository(Personnel::class)->findBy(['estChef' => true]);
// lajout dimage
            if ($request->files->get("personnel")["file"]) {
                $personnel->setPhoto($this->image_uploader($request->files->get("personnel")["file"]));

            }
            else {

                $personnel->setPhoto("user.png");
            }

            // lhistorique
            if ($personnel->getNumCin()) {
                $personnel->setPassword($up->encodePassword($personnel, strtoupper($personnel->getNumCin())));
            }

            $personnel->getPrenomFr();
            $personnel->setNomFr(strtoupper($personnel->getNomFr()));
            $personnel->setNumCin(strtoupper($personnel->getNumCin()));
            $personnel->setNomConjointFr(strtoupper($personnel->getNomConjointFr()));
            $personnel->setPrenomFr(ucfirst($personnel->getPrenomFr()));
            $personnel->setPrenomConjointFr(ucfirst($personnel->getPrenomConjointFr()));


            $historysf = new HistoPersonnel();
            $historysf->setProperty("situation familliale")
                ->setValue($personnel->getSituationFamiliale())
                ->setDateDebut(new \DateTime())
                ->setPersonnel($personnel);
            $entityManager->persist($historysf);

            $historycn = new HistoPersonnel();
            $historycn->setProperty("contrat de travail")
                ->setValue($personnel->getTypeContrat())
                ->setDateDebut(new \DateTime())
                ->setPersonnel($personnel);
            $entityManager->persist($historycn);


            $historyad = new HistoPersonnel();
            $historyad->setProperty("adresse")
                ->setValue($personnel->getAdresseFr())
                ->setDateDebut(new \DateTime())
                ->setPersonnel($personnel);
            $entityManager->persist($historyad);

            if ($personnel->getSituationFamiliale() != "Célibataire") {
                $historynb = new HistoPersonnel();
                $historynb->setProperty("nombre enfants")
                    ->setValue($personnel->getNombreEnfants())
                    ->setDateDebut(new \DateTime())
                    ->setPersonnel($personnel);
                $entityManager->persist($historynb);
            }

            $entityManager->persist($personnel);
            $entityManager->persist($personnelFonction);
            $entityManager->flush();


            return $this->redirectToRoute('personnel_edit', ["id" => $personnel->getId()]);
        }

        return $this->render('personnel/new.html.twig', [
            'personnel' => $personnel,
            'chefs' => $chefs,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="personnel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Personnel $personnel): Response
    {

        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();

        $chefs = $entityManager->getRepository(Personnel::class)->findBy(['estChef' => true]);
        $diplomes = $entityManager->getRepository(Diplome::class)->findAll();
        $fonctions = $entityManager->getRepository(Fonction::class)->findAll();
        $affectations = $entityManager->getRepository(ListAffectation::class)->findAll();


        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->files->get("personnel")["file"]) {
                $personnel->setPhoto($this->image_uploader($request->files->get("personnel")["file"]));

            }

            $chef = $request->request->get("chef");
            if ($personnel->getChef() != $chef) {
                $p = $entityManager->getRepository(Personnel::class)->find($chef);

                ($p) ? $personnel->setChef($p) : $personnel->setChef(null);


            }


            $uow = $entityManager->getUnitOfWork();
            $oldPost = $uow->getOriginalEntityData($personnel);

            if (!$this->comper2champs($personnel->getSituationFamiliale(), $oldPost["situationFamiliale"])) {
                $h = $entityManager->getRepository(HistoPersonnel::class)->findOneBy(["personnel" => $personnel->getId(), "property" => "situation familliale", "dateFin" => null]);

                if ($h) {

                    $h->setDateFin(new \DateTime());
                }

                $phsf = new HistoPersonnel();
                $phsf->setDateDebut(new \DateTime())
                    ->setProperty("situation familliale")
                    ->setValue($personnel->getSituationFamiliale())
                    ->setPersonnel($personnel);


                $entityManager->persist($phsf);


            }


            if (!$this->comper2champs($personnel->getTypeContrat(), $oldPost["typeContrat"])) {
                $h = $entityManager->getRepository(HistoPersonnel::class)->findOneBy(["personnel" => $personnel->getId(), "property" => "contrat de travail", "dateFin" => null]);

                if ($h) {

                    $h->setDateFin(new \DateTime());
                }

                $phcn = new HistoPersonnel();
                $phcn->setDateDebut(new \DateTime())
                    ->setProperty("contrat de travail")
                    ->setValue($personnel->getTypeContrat())
                    ->setPersonnel($personnel);


                $entityManager->persist($phcn);


            }

            if (!$this->comper2champs($personnel->getNombreEnfants(), $oldPost["nombreEnfants"])) {
                $h = $entityManager->getRepository(HistoPersonnel::class)->findOneBy(["personnel" => $personnel->getId(), "property" => "nombre enfants", "dateFin" => null]);
                if ($h) {

                    $h->setDateFin(new \DateTime());
                }


                $phnb = new HistoPersonnel();
                $phnb->setDateDebut(new \DateTime())
                    ->setProperty("nombre enfants")
                    ->setValue($personnel->getNombreEnfants())
                    ->setPersonnel($personnel);


                $entityManager->persist($phnb);

            }
            if (!$this->comper2champs($personnel->getAdresseFr(), $oldPost["adresseFr"])) {
                $h = $entityManager->getRepository(HistoPersonnel::class)->findOneBy(["personnel" => $personnel->getId(), "property" => "adresse", "dateFin" => null]);
                if ($h) {
                    $h->setDateFin(new \DateTime());
                }
                $phad = new HistoPersonnel();
                $phad->setDateDebut(new \DateTime())
                    ->setProperty("adresse")
                    ->setValue($personnel->getAdresseFr())
                    ->setPersonnel($personnel);


                $entityManager->persist($phad);
            }


            dump("----- ");


            $personnel->setNomFr(strtoupper($personnel->getNomFr()));
            $personnel->setNumCin(strtoupper($personnel->getNumCin()));
            $personnel->setNomConjointFr(strtoupper($personnel->getNomConjointFr()));
            $personnel->setPrenomFr(ucfirst($personnel->getPrenomFr()));
            $personnel->setPrenomConjointFr(ucfirst($personnel->getPrenomConjointFr()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personnel_edit', ["id" => $personnel->getId()]);
        }
        $dt = $this->getDoctrine()->getManager()->getRepository(Diplome::class)->findAll();
        return $this->render('personnel/edit.html.twig', [
            'personnel' => $personnel,
            'diplomeType' => $dt,
            'diplomes' => $diplomes,
            'fonctions' => $fonctions,
            'affectations' => $affectations,

            'chefs' => $chefs,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Personnel $personnel): Response
    {
        if ($this->isCsrfTokenValid('delete' . $personnel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnel_index');
    }

    function image_uploader($file)
    {

        $img = $file;


        $up_dir = $this->getParameter("uploads_directory");

        $file_name = md5(uniqid()) . '.' . $img->guessExtension();
        $img->move($up_dir, $file_name);

        return $file_name;
    }


    /**
     * @Route("/affectation", name="personnel_affectation", methods={"GET"})
     */
    public function affectation(MouvementPersonnelRepository $mpRepo): Response
    {
        $pf = $mpRepo->findAll();

        return $this->render('personnel/affectation/affectation.html.twig', [
            'mp' => $pf,


        ]);
    }


    /**
     * @Route("/post_vacant", name="post_vacant_index", methods={"GET"})
     */
    public function postVacant(): Response
    {


        return $this->render('personnel/post_vacant/post_vacant.html.twig', [


        ]);
    }

    /**
     * @Route("/{id}", name="personnel_show", methods={"GET"})
     */
    public function show(Personnel $personnel): Response
    {

        if ($personnel->getDateNaissance() && $personnel->getDateTitularisation()) {

            $age = date_diff($personnel->getDateNaissance(), new \DateTime())->format("%y");
            $enciente = date_diff($personnel->getDateEntree(), $personnel->getDateTitularisation())->format("%y");
        } else {
            $age = "pas assez d'information";
            $enciente = "pas assez d'information";

        }
        return $this->render('personnel/show1.html.twig', [
            'p' => $personnel,
            'age' => $age,
            'encientee' => $enciente

        ]);
    }


    /**
     * @Route("/doc_add", name="personnel_add_doc", methods={"POST"})
     */
    function addDocumentAjax(Request $req)
    {
        if ($req->isXmlHttpRequest()) {

//dd($req->files->get("file"));
//dd($req->request->get("user"));

            $file = $req->files->get("file");
            $em = $this->getDoctrine()->getManager();
            if ($file) {


                $user = $req->request->get("user");

                $user = $em->getRepository(Personnel::class)->find($user);
                $doc = new PersonnelDocumentExterne();
                $doc->setPersonnel($user)->setDateCreation(new \DateTime())->setTitre($file->getClientOriginalName());
                $up_dir = $this->getParameter("uploads_directory");

                $file_name = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($up_dir, $file_name);
                $doc->setCheminDoc($file_name);

                $result = (object)"";
                $result->title = $doc->getTitre();
                $result->path = $file_name;

                $em->persist($doc);
                $em->flush();


                //return $file_name;
                return new JsonResponse([
                    json_encode($result)
                ]);
            } else {

            }


        }
    }

    /**
     * @Route("/fonc_add", name="personnel_add_fonc", methods={"POST"})
     */
    function addFonctionAjax(Request $req)
    {


        if ($req->isXmlHttpRequest()) {


            $em = $this->getDoctrine()->getManager();

            $affecattionid = $req->request->get("affecattionid");
            $fonctionid = $req->request->get("fonctionid");
            $datedebut = $req->request->get("datedebut");
            $datefin = $req->request->get("datefin");
            $observation = $req->request->get("observation");
            $userid = $req->request->get("userid");


            $user = $em->getRepository(Personnel::class)->find($userid);


            $affectation = $em->getRepository(ListAffectation::class)->find($affecattionid);
            $fonction = $em->getRepository(Fonction::class)->find($fonctionid);

            if ($fonction && $affectation) {


                $fonc = new PersonnelFonction();
                $fonc->setPersonnel($user)
                    ->setDateDebut(new \DateTime($datedebut))
                    ->setDateFin(new \DateTime($datefin))
                    ->setObservation($observation)
                    ->setFonction($fonction)
                    ->setLieuAffectation($affectation);


                $em->persist($fonc);
                $em->flush();

                $result = [
                    "id" => $fonc->getId(),
                    "affectation" => $fonc->getLieuAffectation()->getLibelleFr(),
                    "fonction" => $fonc->getFonction()->getLibelleFr(),
                    "datedebut" => $fonc->getDateDebut(),
                    "datefin" => $fonc->getDateFin(),
                    "observation" => $fonc->getObservation(),

                ];


                //return $file_name;
                return new JsonResponse([
                    json_encode($result)
                ]);

            } else {

                $result = ["error" => "error"];

                return new JsonResponse([
                    json_encode($result)
                ]);
            }
        }
    }

    /**
     * @Route("/dip_add", name="personnel_add_dip", methods={"POST"})
     */
    function addDiplomeAjax(Request $req)
    {
        if ($req->isXmlHttpRequest()) {

//dd($req->files->get("file"));


            $file = $req->files->get("file");
            $em = $this->getDoctrine()->getManager();
            if ($file) {


                $user = $req->request->get("user");
                $designation = $req->request->get("designation");
                $date = $req->request->get("date");
                $etablssement = $req->request->get("etablissement");
                $specialite = $req->request->get("spesialite");
                $typediplome = $req->request->get("type");


                //date making

                $input = '06/6/' . $date;

                $dates = new \DateTime();

                $date = $dates->createFromFormat('d/m/Y', $input);

                $user = $em->getRepository(Personnel::class)->find($user);
                $dip = new  PersonnelDiplome();
                $dip->setPersonnel($user)->setDateObtention($date)->setDesignation($designation)->setEtablissement($etablssement)->setSpecialite($specialite);
                $up_dir = $this->getParameter("uploads_directory");

                $file_name = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($up_dir, $file_name);
                $dip->setCheminDoc($file_name);

                $nomdip = $em->getRepository(Diplome::class)->find($typediplome);
                $dip->setDiplome($nomdip);
                $em->persist($dip);
                $em->flush();
                $result = (object)"";
                $result->designation = $dip->getDesignation();
                $result->chemindoc = $file_name;
                $result->dipid = $dip->getId();
                $result->etablissement = $etablssement;
                $result->dateobtention = $date;
                $result->specialite = $specialite;
                $result->typedip = $nomdip->getLibelleFr();


                //return $file_name;
                return new JsonResponse([
                    json_encode($result)
                ]);
            } else {

            }


        }
    }

    function comper2champs($a, $b)
    {

        return ($a == $b);
    }

}
