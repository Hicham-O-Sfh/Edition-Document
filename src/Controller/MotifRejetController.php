<?php

namespace App\Controller;

use App\Entity\MotifRejet;
use App\Form\MotifRejetType;
use App\Repository\MotifRejetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/motif/rejet")
 */
class MotifRejetController extends AbstractController
{
    /**
     * @Route("/", name="motif_rejet_index", methods={"GET"})
     */
    public function index(MotifRejetRepository $motifRejetRepository): Response
    {
        return $this->render('motif_rejet/index.html.twig', [
            'motif_rejets' => $motifRejetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="motif_rejet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $motifRejet = new MotifRejet();
        $form = $this->createForm(MotifRejetType::class, $motifRejet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($motifRejet);
            $entityManager->flush();

            return $this->redirectToRoute('motif_rejet_new');
        }

        return $this->render('motif_rejet/new.html.twig', [
            'motif_rejet' => $motifRejet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="motif_rejet_show", methods={"GET"})
     */
    public function show(MotifRejet $motifRejet): Response
    {
        return $this->render('motif_rejet/show.html.twig', [
            'motif_rejet' => $motifRejet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="motif_rejet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MotifRejet $motifRejet): Response
    {
        $form = $this->createForm(MotifRejetType::class, $motifRejet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('motif_rejet_new');
        }

        return $this->render('motif_rejet/edit.html.twig', [
            'motif_rejet' => $motifRejet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="motif_rejet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MotifRejet $motifRejet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motifRejet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($motifRejet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parametrage_spe');
    }
    /**
     * @Route("/{id}/del", name="motif_delete")
     */
    public function del(MotifRejetRepository $motifRejetRepository , $id): Response
    {
        $motifRejet = $motifRejetRepository->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($motifRejet);
        $entityManager->flush();
        return $this->redirectToRoute('parametrage_spe');
    }
}
