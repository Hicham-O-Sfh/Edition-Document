<?php

namespace App\Controller;

use App\Entity\NatureConge;
use App\Form\NatureCongeType;
use App\Repository\NatureCongeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nature_conge")
 */
class NatureCongeController extends AbstractController
{
    /**
     * @Route("/", name="nature_conge_index", methods={"GET"})
     */
    public function index(NatureCongeRepository $natureCongeRepository): Response
    {
        return $this->render('nature_conge/index.html.twig', [
            'nature_conges' => $natureCongeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nature_conge_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $natureConge = new NatureConge();
        $form = $this->createForm(NatureCongeType::class, $natureConge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($natureConge);
            $entityManager->flush();

            return $this->redirectToRoute('nature_conge_new');
        }

        return $this->render('nature_conge/new.html.twig', [
            'nature_conge' => $natureConge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nature_conge_show", methods={"GET"})
     */
    public function show(NatureConge $natureConge): Response
    {
        return $this->render('nature_conge/show.html.twig', [
            'nature_conge' => $natureConge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nature_conge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NatureConge $natureConge): Response
    {
        $form = $this->createForm(NatureCongeType::class, $natureConge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nature_conge_edit');
        }

        return $this->render('nature_conge/edit.html.twig', [
            'nature_conge' => $natureConge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nature_conge_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NatureConge $natureConge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$natureConge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($natureConge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nature_conge_index');
    }
    /**
     * @Route("/{id}/del", name="congé_delete")
     */
    public function del(NatureCongeRepository $natureCongeRepository , $id): Response
    {
        $natureConge = $natureCongeRepository->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($natureConge);
        $entityManager->flush();
        return $this->redirectToRoute('parametrage_spe');
    }
}
