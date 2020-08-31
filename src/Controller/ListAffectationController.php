<?php

namespace App\Controller;

use App\Entity\ListAffectation;
use App\Form\ListAffectationType;
use App\Repository\ListAffectationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/list_affectation")
 */
class ListAffectationController extends AbstractController
{
    /**
     * @Route("/", name="list_affectation_index", methods={"GET"})
     */
    public function index(ListAffectationRepository $listAffectationRepository): Response
    {
        return $this->render('list_affectation/index.html.twig', [
            'list_affectations' => $listAffectationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="list_affectation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $listAffectation = new ListAffectation();
        $form = $this->createForm(ListAffectationType::class, $listAffectation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($listAffectation);
            $entityManager->flush();

            return $this->redirectToRoute('list_affectation_new');
        }

        return $this->render('list_affectation/new.html.twig', [
            'list_affectation' => $listAffectation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="list_affectation_show", methods={"GET"})
     */
    public function show(ListAffectation $listAffectation): Response
    {
        return $this->render('list_affectation/show.html.twig', [
            'list_affectation' => $listAffectation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="list_affectation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ListAffectation $listAffectation): Response
    {
        $form = $this->createForm(ListAffectationType::class, $listAffectation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list_affectation_edit');
        }

        return $this->render('list_affectation/edit.html.twig', [
            'list_affectation' => $listAffectation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="list_affectation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ListAffectation $listAffectation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listAffectation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($listAffectation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parametrage_spe');
    }
    /**
     * @Route("/{id}/del", name="affec_delete")
     */
    public function del(ListAffectationRepository $listAffectationRepository , $id): Response
    {
        $listAffectationRepository = $listAffectationRepository->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($listAffectationRepository);
        $entityManager->flush();
        return $this->redirectToRoute('parametrage_spe');
    }
}
