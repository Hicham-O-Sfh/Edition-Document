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
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @Route("/ajaxGetModelById/{id}", name="ajaxGetModelById" , methods={"GET"})
     */
    public function ajaxGetModelById(ModelDocument $modelDocument)
    {
        return new JsonResponse($modelDocument->getContent());
    }

    /**
     * @Route("/phpmyadmin")
     */
    public function redirectToPanel()
    {
        return $this->redirect('http://localhost/phpmyadmin');
    }

    /**
     * @Route("/Creer-Un-Document", name="model_document_make")
     */
    public function make(ModelDocumentRepository $modelDocuments, PersonnelRepository $users)
    {
        return $this->render(
            'model_document/make.html.twig',
            [
                'documents' => $modelDocuments->findAll(),
                'users' => $users->findAll()
            ]
        );
    }

    /**
     * @Route("/Creer-Un-Modele", name="add" , methods={"GET","POST"})
     */
    public function add(Request $request): Response
    {
        $modelDocument = new ModelDocument();
        $form = $this->createForm(ModelDocumentType::class, $modelDocument);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $modelDocument->setDateCreation(new \DateTime());
            $entityManager->persist($modelDocument);
            $entityManager->flush();

            return $this->redirectToRoute('model_document_index');
        }

        $conn =  $entityManager->getConnection();
        $columns = $conn->fetchAll("
        SELECT column_name as colName
        FROM information_schema.columns 
        WHERE table_schema = 'si_anoc_bd_test' 
            AND table_name = 'personnel'
            AND column_name IN ('email_professionnel', 'num_cin', 'matricule', 'nom_fr', 'prenom_fr', 'nom_ar', 'prenom_ar', 'nom_conjoint_ar', 'prenom_conjoint_ar', 'sexe', 'tel_professionnel', 'est_personnel')
        ");

        return $this->render('model_document/add.html.twig', [
            'model_document' => $modelDocument,
            'documentModelForm' => $form->createView(),
            'columns' => $columns,
        ]);
    }

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
