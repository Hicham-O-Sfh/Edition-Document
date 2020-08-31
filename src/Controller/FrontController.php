<?php
namespace App\Controller;

use App\Entity\HistoPersonnel;
use App\Entity\Personnel;
use App\Entity\PersonnelFonction;
use App\Entity\PersonnelMission;
use App\Entity\TypeContrat;
use App\Form\TypeContratType;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    /**
     * @Route("", name="front")
     */
    public function index()
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }



    /**
     * @Route("/historique/salarie_active", name="active_salaries")
     */
    public function activeSalariesIndex()
    {
$em =$this->getDoctrine();

       $obj=   $em->getRepository(HistoPersonnel::class)->findAll();
       $missions = $em->getRepository(PersonnelMission::class)->findall();
       $fonctions = $em->getRepository(PersonnelFonction::class)->findall();


        return $this->render('historique/salarieActive.html.twig', [
            'history' =>     $obj  ,
            "missions" => $missions,
            "fonctions"=>$fonctions
        ]);
    }


    /**
     * @Route("/historique/salarie_sortie", name="went_salaries")
     */
    public function sortieSalariesIndex()
    {


        $obj=   $this->getDoctrine()->getRepository(Personnel::class)->findBy([
            "etat"=>"parti"
        ]);

        return $this->render('historique/salarieSortie.html.twig', [
            'personnels' =>     $obj  ,
        ]);
    }
}
