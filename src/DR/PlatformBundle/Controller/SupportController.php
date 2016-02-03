<?php

namespace DR\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DR\PlatformBundle\Entity\Support;
use DR\PlatformBundle\Form\SupportType;

/**
 * Support controller.
 *
 * @Route("/support")
 */
class SupportController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $supports = $em->getRepository('DRPlatformBundle:Support')->findAll();

        return $this->render('DRPlatformBundle:Art:Support/index.html.twig', array(
            'supports' => $supports,
        ));
    }

    public function newAction(Request $request)
    {
        $support = new Support();
        $form = $this->createForm('DR\PlatformBundle\Form\SupportType', $support);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($support);
            $em->flush();

            return $this->redirectToRoute('dr_support_show', array('id' => $support->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Support/new.html.twig', array(
            'support' => $support,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Support $support)
    {
        $deleteForm = $this->createDeleteForm($support);

        return $this->render('DRPlatformBundle:Art:Support/show.html.twig', array(
            'support' => $support,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Support $support)
    {
        $deleteForm = $this->createDeleteForm($support);
        $editForm = $this->createForm('DR\PlatformBundle\Form\SupportType', $support);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($support);
            $em->flush();

            return $this->redirectToRoute('dr_support_edit', array('id' => $support->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Support/edit.html.twig', array(
            'support' => $support,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Support $support)
    {
        $form = $this->createDeleteForm($support);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($support);
            $em->flush();
        }

        return $this->redirectToRoute('dr_support_index');
    }

    /**
     * Creates a form to delete a Support entity.
     *
     * @param Support $support The Support entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Support $support)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dr_support_delete', array('id' => $support->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
