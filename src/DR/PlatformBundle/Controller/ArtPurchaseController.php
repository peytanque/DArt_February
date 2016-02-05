<?php

namespace DR\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DR\PlatformBundle\Entity\ArtPurchase;
use DR\PlatformBundle\Form\ArtPurchaseType;

/**
 * ArtPurchase controller.
 *
 * @Route("/artpurchase")
 */
class ArtPurchaseController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $artPurchases = $em->getRepository('DRPlatformBundle:ArtPurchase')->findAll();

        return $this->render('DRPlatformBundle:Art:ArtPurchase/index.html.twig', array(
            'artPurchases' => $artPurchases,
        ));
    }


    public function newAction(Request $request)
    {
        $artPurchase = new ArtPurchase();
        $form = $this->createForm('DR\PlatformBundle\Form\ArtPurchaseType', $artPurchase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artPurchase);
            $em->flush();

            return $this->redirectToRoute('dr_artpurchase_show', array('id' => $artPurchase->getId()));
        }

        return $this->render('DRPlatformBundle:Art:ArtPurchase/new.html.twig', array(
            'artPurchase' => $artPurchase,
            'form' => $form->createView(),
        ));
    }

    public function showAction(ArtPurchase $artPurchase)
    {
        $deleteForm = $this->createDeleteForm($artPurchase);

        return $this->render('DRPlatformBundle:Art:ArtPurchase/show.html.twig', array(
            'artPurchase' => $artPurchase,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, ArtPurchase $artPurchase)
    {
        $deleteForm = $this->createDeleteForm($artPurchase);
        $editForm = $this->createForm('DR\PlatformBundle\Form\ArtPurchaseType', $artPurchase);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artPurchase);
            $em->flush();

            return $this->redirectToRoute('dr_artpurchase_edit', array('id' => $artPurchase->getId()));
        }

        return $this->render('DRPlatformBundle:Art:ArtPurchase/edit.html.twig', array(
            'artPurchase' => $artPurchase,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, ArtPurchase $artPurchase)
    {
        $form = $this->createDeleteForm($artPurchase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artPurchase);
            $em->flush();
        }

        return $this->redirectToRoute('dr_artpurchase_index');
    }

    /**
     * Creates a form to delete a ArtPurchase entity.
     *
     * @param ArtPurchase $artPurchase The ArtPurchase entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ArtPurchase $artPurchase)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dr_artpurchase_delete', array('id' => $artPurchase->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
