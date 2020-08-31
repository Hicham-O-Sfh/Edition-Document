<?php

namespace App\Controller;

use App\Entity\TypeContrat;
use App\Repository\FonctionRepository;
use App\Repository\ListAffectationRepository;
use App\Repository\MotifRejetRepository;
use App\Repository\NatureCongeRepository;
use App\Repository\TypeContratRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParametrageSpeController extends AbstractController
{
    /**
     * @Route("/parametrage", name="parametrage_spe")
     */
    public function index(TypeContratRepository $typeContratRepository , MotifRejetRepository $motifRejetRepository , ListAffectationRepository $listAffectationRepository , NatureCongeRepository $natureCongeRepository , FonctionRepository $fonctionRepository)
    {
        return $this->render('parametrage_spe/index.html.twig', [
            'type_contrats' => $typeContratRepository->findAll(),
            'motif_rejets' => $motifRejetRepository->findAll(),
            'list_affectations' => $listAffectationRepository->findAll(),
            'nature_conges'=> $natureCongeRepository->findAll(),
            'fonctions' => $fonctionRepository->findAll(),
        ]);
    }

}
