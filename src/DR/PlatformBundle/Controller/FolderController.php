<?php

namespace DR\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DR\PlatformBundle\Entity\Folder;
use DR\PlatformBundle\Form\FolderType;

/**
 * Folder controller.
 *
 * @Route("/folder")
 */
class FolderController extends Controller
{ 

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $folders = $em->getRepository('DRPlatformBundle:Folder')->findAll();
        $refs = $em->getRepository('DRPlatformBundle:Ref')->findAll();

        return $this->render('DRPlatformBundle:Art:Folder/index.html.twig', array(
            'folders' => $folders,
            'refs' => $refs,
        ));
    }

    public function newAction(Request $request)
    {
        $folder = new Folder();
        $form = $this->createForm('DR\PlatformBundle\Form\FolderType', $folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($folder);
            $em->flush();

            return $this->redirectToRoute('dr_folder_show', array('id' => $folder->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Folder/new.html.twig', array(
            'folder' => $folder,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Folder $folder)
    {
        $deleteForm = $this->createDeleteForm($folder);

        return $this->render('DRPlatformBundle:Art:Folder/show.html.twig', array(
            'folder' => $folder,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Folder $folder)
    {
        $deleteForm = $this->createDeleteForm($folder);
        $editForm = $this->createForm('DR\PlatformBundle\Form\FolderType', $folder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($folder);
            $em->flush();

            return $this->redirectToRoute('dr_folder_show', array('id' => $folder->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Folder/edit.html.twig', array(
            'folder' => $folder,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Folder $folder)
    {
        $form = $this->createDeleteForm($folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($folder);
            $em->flush();
        }

        return $this->redirectToRoute('dr_folder_index');
    }

    /**
     * Creates a form to delete a Folder entity.
     *
     * @param Folder $folder The Folder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Folder $folder)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dr_folder_delete', array('id' => $folder->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
