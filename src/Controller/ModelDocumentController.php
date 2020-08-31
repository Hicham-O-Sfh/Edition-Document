<?php

namespace App\Controller;

use App\Entity\ModelDocument;
use App\Repository\ModelDocumentRepository;
use App\Repository\PersonnelRepository;
use App\Form\ModelDocumentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/model/document")
 */

class ModelDocumentController extends AbstractController
{
    /**
     * @Route("/", name="model_document_index", methods={"GET"})
     */
    public function index(ModelDocumentRepository $modelDocumentRepository): Response
    {
        return $this->render('model_document/index.html.twig', [
            'model_documents' => $modelDocumentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/getdataall", name="getdataall", methods={"GET"})
     */
    public function getdata(ModelDocumentRepository $modelDocuments, PersonnelRepository $users): Response
    {
        $models = [];
        $resp = [];
        $docs = $modelDocuments->findAll();
        $personell = $users->findAll();

        foreach ($docs as $raw) {
            $model = new ModelDocument();
            $model->setId($raw->getId());
            $model->setContent(html_entity_decode($raw->getContent()));
            array_push($models, $model);
        }
        array_push($resp, $models);
        array_push($resp, $personell);
        return $this->json(["code" => 200, "models" => $resp], 200);
    }

    /**
     * @Route("/make", name="model_document_make")
     * @Route("/getdata/{id}", name="getdata")
     */
    public function make(ModelDocumentRepository $modelDocuments, PersonnelRepository $users)
    {
        return $this->render(
            'model_document/make.html.twig',
            ['documents' => $modelDocuments->findAll(), 'users' => $users->findAll()]
        );
    }

    /**
     * @Route("/add", name="add" , methods={"GET","POST"})
     */
    public function add(Request $request): Response
    {
        //ModelDocument
        // if ($req->request->count() > 0) {
        //     $models = new ModelDocument();
        //     $models->setDateCreation(new \DateTime());
        //     $models->setDetails($req->request->get('modeldetails'));
        //     $models->setContent(htmlentities($req->request->get('content')));
        //     $models->setIntitule($req->request->get('modelname'));

        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($models);
        //     $entityManager->flush();
        // }

        $modelDocument = new ModelDocument();
        $form = $this->createForm(ModelDocumentType::class, $modelDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modelDocument);
            $entityManager->flush();

            return $this->redirectToRoute('model_document_index');
        }

        return $this->render('model_document/add.html.twig', [
            'model_document' => $modelDocument,
            'documentModelForm' => $form->createView(),
        ]);
    }

    // /**
    //  * @Route("/new", name="model_document_new", methods={"GET","POST"})
    //  */
    // public function new(Request $request): Response
    // {
    //     $modelDocument = new ModelDocument();
    //     $form = $this->createForm(ModelDocumentType::class, $modelDocument);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($modelDocument);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('model_document_index');
    //     }

    //     return $this->render('model_document/new.html.twig', [
    //         'model_document' => $modelDocument,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="model_document_show", methods={"GET"})
    //  */
    // public function show(ModelDocument $modelDocument): Response
    // {
    //     return $this->render('model_document/show.html.twig', [
    //         'model_document' => $modelDocument,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}/edit", name="model_document_edit", methods={"GET","POST"})
    //  */
    // public function edit(Request $request, ModelDocument $modelDocument): Response
    // {
    //     $form = $this->createForm(ModelDocumentType::class, $modelDocument);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('model_document_index');
    //     }

    //     return $this->render('model_document/edit.html.twig', [
    //         'model_document' => $modelDocument,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="model_document_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, ModelDocument $modelDocument): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$modelDocument->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($modelDocument);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('model_document_index');
    // }
}
