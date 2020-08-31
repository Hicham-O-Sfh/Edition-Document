<?php

namespace App\Controller;

use App\Entity\PersonnelDiplome;
use App\Form\PersonnelDiplomeType;
use App\Repository\PersonnelDiplomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personnel_diplome")
 */
class PersonnelDiplomeController extends AbstractController
{
    /**
     * @Route("/", name="personnel_diplome_index", methods={"GET"})
     */
    public function index(PersonnelDiplomeRepository $personnelDiplomeRepository): Response
    {
        return $this->render('personnel_diplome/index.html.twig', [
            'personnel_diplomes' => $personnelDiplomeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="personnel_diplome_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personnelDiplome = new PersonnelDiplome();
        $form = $this->createForm(PersonnelDiplomeType::class, $personnelDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->files->get("personnel_diplome")["file"]){
                $personnelDiplome->setCheminDoc($this->diplome_uploader($request->files->get("personnel_diplome")["file"]));

            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personnelDiplome);
            $entityManager->flush();

            return $this->redirectToRoute('personnel_diplome_index');
        }

        return $this->render('personnel_diplome/new.html.twig', [
            'personnel_diplome' => $personnelDiplome,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_diplome_show", methods={"GET"})
     */
    public function show(PersonnelDiplome $personnelDiplome): Response
    {
        return $this->render('personnel_diplome/show.html.twig', [
            'personnel_diplome' => $personnelDiplome,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="personnel_diplome_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PersonnelDiplome $personnelDiplome): Response
    {
        $form = $this->createForm(PersonnelDiplomeType::class, $personnelDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->files->get("personnel_diplome")["file"]){
                $personnelDiplome->setCheminDoc($this->diplome_uploader($request->files->get("personnel_diplome")["file"]));

            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personnel_diplome_index');
        }

        return $this->render('personnel_diplome/edit.html.twig', [
            'personnel_diplome' => $personnelDiplome,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_diplome_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PersonnelDiplome $personnelDiplome): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnelDiplome->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnelDiplome);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnel_diplome_index');
    }

    function diplome_uploader($file){




        $up_dir = $this->getParameter("uploads_directory");

        $file_name = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($up_dir,$file_name);

        return $file_name;
    }
}
