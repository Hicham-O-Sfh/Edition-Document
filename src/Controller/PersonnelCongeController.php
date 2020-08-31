<?php

namespace App\Controller;

use App\Entity\PersonnelConge;
use App\Form\PersonnelCongeType;
use App\Repository\PersonnelCongeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personnel_conge")
 */
class PersonnelCongeController extends AbstractController
{
    /**
     * @Route("/", name="personnel_conge_index", methods={"GET"})
     */
    public function index(PersonnelCongeRepository $personnelCongeRepository): Response
    {
        return $this->render('personnel_conge/index.html.twig', [
            'personnel_conges' => $personnelCongeRepository->findBy(array('personnel' => $this->getUser()->getId())),
        ]);
    }

    /**
     * @Route("/new", name="personnel_conge_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personnelConge = new PersonnelConge();
        $form = $this->createForm(PersonnelCongeType::class, $personnelConge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $currentUser = $this->getUser();
            $personnelConge->setPersonnel($currentUser);
            $entityManager->persist($personnelConge);
            $entityManager->flush();

            return $this->redirectToRoute('personnel_conge_index');
        }

        return $this->render('personnel_conge/new.html.twig', [
            'personnel_conge' => $personnelConge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_conge_show", methods={"GET"})
     */
    public function show(PersonnelConge $personnelConge): Response
    {
        return $this->render('personnel_conge/show.html.twig', [
            'personnel_conge' => $personnelConge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="personnel_conge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PersonnelConge $personnelConge): Response
    {
        $form = $this->createForm(PersonnelCongeType::class, $personnelConge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personnel_conge_index');
        }

        return $this->render('personnel_conge/edit.html.twig', [
            'personnel_conge' => $personnelConge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_conge_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PersonnelConge $personnelConge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnelConge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnelConge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnel_conge_index');
    }
        /**
     * @Route("/{id}/del", name="persConge_delete")
     */
    public function del(PersonnelConge $personnelConge): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($personnelConge);
        $entityManager->flush();
        return $this->redirectToRoute('personnel_conge_index');
    }
    
}
