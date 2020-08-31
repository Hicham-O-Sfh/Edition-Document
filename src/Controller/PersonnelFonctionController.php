<?php

namespace App\Controller;

use App\Entity\PersonnelFonction;
use App\Form\PersonnelFonctionType;
use App\Repository\PersonnelFonctionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personnel_fonction")
 */
class PersonnelFonctionController extends AbstractController
{
    /**
     * @Route("/", name="personnel_fonction_index", methods={"GET"})
     */
    public function index(PersonnelFonctionRepository $personnelFonctionRepository): Response
    {
        return $this->render('personnel_fonction/index.html.twig', [
            'personnel_fonctions' => $personnelFonctionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="personnel_fonction_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personnelFonction = new PersonnelFonction();
        $form = $this->createForm(PersonnelFonctionType::class, $personnelFonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personnelFonction);
            $entityManager->flush();

            return $this->redirectToRoute('personnel_fonction_index');
        }

        return $this->render('personnel_fonction/new.html.twig', [
            'personnel_fonction' => $personnelFonction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_fonction_show", methods={"GET"})
     */
    public function show(PersonnelFonction $personnelFonction): Response
    {
        return $this->render('personnel_fonction/show.html.twig', [
            'personnel_fonction' => $personnelFonction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="personnel_fonction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PersonnelFonction $personnelFonction): Response
    {
        $form = $this->createForm(PersonnelFonctionType::class, $personnelFonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personnel_fonction_index');
        }

        return $this->render('personnel_fonction/edit.html.twig', [
            'personnel_fonction' => $personnelFonction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_fonction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PersonnelFonction $personnelFonction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnelFonction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnelFonction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnel_fonction_index');
    }
}
