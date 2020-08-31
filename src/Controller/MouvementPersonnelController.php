<?php

namespace App\Controller;

use App\Entity\MouvementPersonnel;
use App\Form\MouvementPersonnelType;
use App\Repository\MouvementPersonnelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mouvement_personnel")
 */
class MouvementPersonnelController extends AbstractController
{
    /**
     * @Route("/", name="mouvement_personnel_index", methods={"GET"})
     */
    public function index(MouvementPersonnelRepository $mouvementPersonnelRepository): Response
    {
        return $this->render('mouvement_personnel/index.html.twig', [
            'mouvement_personnels' => $mouvementPersonnelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mouvement_personnel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $mouvementPersonnel = new MouvementPersonnel();
        $form = $this->createForm(MouvementPersonnelType::class, $mouvementPersonnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($request->files->get("mouvement_personnel")["file"]){

                $file = $request->files->get("mouvement_personnel")["file"];

                $up_dir = $this->getParameter("uploads_directory");

                $file_name = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($up_dir, $file_name);

                $mouvementPersonnel->setFichier($file_name);
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mouvementPersonnel);
            $entityManager->flush();

            return $this->redirectToRoute('mouvement_personnel_index');
        }

        return $this->render('mouvement_personnel/new.html.twig', [
            'mouvement_personnel' => $mouvementPersonnel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mouvement_personnel_show", methods={"GET"})
     */
    public function show(MouvementPersonnel $mouvementPersonnel): Response
    {
        return $this->render('mouvement_personnel/show.html.twig', [
            'mouvement_personnel' => $mouvementPersonnel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mouvement_personnel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MouvementPersonnel $mouvementPersonnel): Response
    {
        $form = $this->createForm(MouvementPersonnelType::class, $mouvementPersonnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($request->files->get("mouvement_personnel")["file"]){

                $file = $request->files->get("mouvement_personnel")["file"];

                $up_dir = $this->getParameter("uploads_directory");

                $file_name = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($up_dir, $file_name);

                $mouvementPersonnel->setFichier($file_name);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mouvement_personnel_index');
        }

        return $this->render('mouvement_personnel/edit.html.twig', [
            'mouvement_personnel' => $mouvementPersonnel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mouvement_personnel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MouvementPersonnel $mouvementPersonnel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mouvementPersonnel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mouvementPersonnel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mouvement_personnel_index');
    }
}
