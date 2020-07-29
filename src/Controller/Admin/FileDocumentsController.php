<?php

namespace App\Controller\Admin;

use App\Entity\FileDocuments;
use App\Form\FileDocumentsType;
use App\Repository\FileDocumentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/documents")
 */
class FileDocumentsController extends AbstractController
{
    /**
     * @Route("/", name="file_documents_index", methods={"GET"})
     */
    public function index(FileDocumentsRepository $fileDocumentsRepository): Response
    {
        return $this->render('admin/file_documents/index.html.twig', [
            'file_documents' => $fileDocumentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="file_documents_new", methods={"GET","POST"})
     */
    public function new(Request $request, $id, FileDocumentsRepository $fileDocumentsRepository): Response
    {
        $fileDocument = new FileDocuments();
        $form = $this->createForm(FileDocumentsType::class, $fileDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                // Move the file to the directory where brochures are stored
                $imageFile->move(
                    $this->getParameter('Documents'),
                    $newFilename
                );


                $fileDocument->setImage($newFilename);
                //return $this->redirect($this->generateUrl('app_product_list'));
            }



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fileDocument);
            $entityManager->flush();

           // return $this->redirectToRoute('file_documents_index');
            return $this->redirectToRoute('file_documents_new', ['id'=> $id]);

        }
        $Documents = $fileDocumentsRepository->findBy(['Cases'=> $id]);


        return $this->render('admin/file_documents/new.html.twig', [
            'file_document' => $fileDocument,
            'id'=>$id,
            'document'=> $Documents,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="file_documents_show", methods={"GET"})
     */
    public function show(FileDocuments $fileDocument): Response
    {
        return $this->render('admin/file_documents/show.html.twig', [
            'file_document' => $fileDocument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="file_documents_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FileDocuments $fileDocument): Response
    {
        $form = $this->createForm(FileDocumentsType::class, $fileDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('file_documents_index');
        }

        return $this->render('admin/file_documents/edit.html.twig', [
            'file_document' => $fileDocument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="file_documents_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FileDocuments $fileDocument): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fileDocument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fileDocument);
            $entityManager->flush();
        }

        return $this->redirectToRoute('file_documents_index');
    }
}
