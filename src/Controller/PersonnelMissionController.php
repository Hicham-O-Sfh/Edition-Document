<?php

namespace App\Controller;

use App\Entity\PersonnelMission;
use App\Form\PersonnelMissionType;
use App\Repository\PersonnelRepository;
use App\Form\RejeterPersonnelMissionType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PersonnelMissionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/personnel_mission")
 */
class PersonnelMissionController extends AbstractController
{
    /**
     * @Route("/", name="personnel_mission_index", methods={"GET"})
     */
    public function index(PersonnelMissionRepository $personnelMissionRepository): Response
    {
        // dd($this->getUser()->getPersonnelFonctions());
        return $this->render('personnel_mission/index.html.twig', [
            'personnel_missions' => $personnelMissionRepository->findBy(array('personnel' => $this->getUser()->getId())),
        ]);
    }
    /**
     * @Route("/missions", name="missions")
     */
    public function missions(PersonnelMissionRepository $personnelMissionRepository,PersonnelRepository $personnelRepository): Response
    {
        // $persMiss = $personnelMissionRepository->findBy([])
        // $allPersonnelMissions = $this->getUser()->getPersonnels();
        $perso =$this->getUser();
       // dump($allPersonnelMissions->getPersonnels());die();
        return $this->render('personnel_mission/missions.html.twig',[
             
            'perso'=>$perso,
        ]);
    }
    /**
     * @Route("/new", name="personnel_mission_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personnelMission = new PersonnelMission();
        $form = $this->createForm(PersonnelMissionType::class, $personnelMission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $currentUser = $this->getUser();
            $personnelMission->setPersonnel($currentUser);
            $entityManager->persist($personnelMission);
            $entityManager->flush();

            return $this->redirectToRoute('personnel_mission_index');
        }

        return $this->render('personnel_mission/new.html.twig', [
            'personnel_mission' => $personnelMission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_mission_show", methods={"GET"})
     */
    public function show(PersonnelMission $personnelMission): Response
    {
        return $this->render('personnel_mission/show.html.twig', [
            'personnel_mission' => $personnelMission,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="personnel_mission_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PersonnelMission $personnelMission): Response
    {
        $form = $this->createForm(PersonnelMissionType::class, $personnelMission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personnel_mission_index');
        }

        return $this->render('personnel_mission/edit.html.twig', [
            'personnel_mission' => $personnelMission,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/editmission", name="mission_edit", methods={"GET","POST"})
     */
    public function editmission(Request $request, PersonnelMission $personnelMission): Response
    {
            $personnelMission->setDecisionChef('validée');
            $this->getDoctrine()->getManager()->flush();
            // $em->flush($personnelMission);
            return $this->redirectToRoute('missions');
    }
     /**
     * @Route("/{id}/reject", name="personnel_mission_reject", methods={"GET","POST"})
     */
    public function rejeterMission(Request $request, PersonnelMission $personnelMission): Response
    {
        $form = $this->createForm(RejeterPersonnelMissionType::class, $personnelMission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnelMission->setDateDecisionChef(new \DateTime());
            $personnelMission->setDecisionChef("rejetée");
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('missions');
        }

        return $this->render('personnel_mission/rejeterPersonnelMission.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="personnel_mission_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PersonnelMission $personnelMission): Response
    {
        if ($this->isCsrfTokenValid('delete' . $personnelMission->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnelMission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnel_mission_index');
    }
    /**
     * @Route("/{id}/del", name="persMission_delete")
     */
    public function del(PersonnelMission $personnelMission): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($personnelMission);
        $entityManager->flush();
        return $this->redirectToRoute('personnel_mission_index');
    }
    
}
