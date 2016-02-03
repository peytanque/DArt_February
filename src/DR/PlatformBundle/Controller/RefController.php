<?php

namespace DR\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DR\PlatformBundle\Entity\Ref;
use DR\PlatformBundle\Form\RefType;

/**
 * Ref controller.
 *
 * @Route("/ref")
 */
class RefController extends Controller
{
    /**
     * Lists all Ref entities.
     *
     * @Route("/", name="ref_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refs = $em->getRepository('DRPlatformBundle:Ref')->findAll();

        return $this->render('DRPlatformBundle:Art:Ref/index.html.twig', array(
            'refs' => $refs,
        ));
    }

    /**
     * Creates a new Ref entity.
     *
     * @Route("/new", name="ref_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ref = new Ref();
        $form = $this->createForm('DR\PlatformBundle\Form\RefType', $ref);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ref);
            $em->flush();

            return $this->redirectToRoute('dr_ref_show', array('id' => $ref->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Ref/new.html.twig', array(
            'ref' => $ref,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ref entity.
     *
     * @Route("/{id}", name="ref_show")
     * @Method("GET")
     */
    public function showAction(Ref $ref)
    {
        $deleteForm = $this->createDeleteForm($ref);

        return $this->render('DRPlatformBundle:Art:Ref/show.html.twig', array(
            'ref' => $ref,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ref entity.
     *
     * @Route("/{id}/edit", name="ref_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ref $ref)
    {
        $deleteForm = $this->createDeleteForm($ref);
        $editForm = $this->createForm('DR\PlatformBundle\Form\RefType', $ref);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ref);
            $em->flush();

            return $this->redirectToRoute('dr_ref_edit', array('id' => $ref->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Ref/edit.html.twig', array(
            'ref' => $ref,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ref entity.
     *
     * @Route("/{id}", name="ref_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ref $ref)
    {
        $form = $this->createDeleteForm($ref);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ref);
            $em->flush();
        }

        return $this->redirectToRoute('dr_ref_index');
    }

    /**
     * Creates a form to delete a Ref entity.
     *
     * @param Ref $ref The Ref entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ref $ref)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dr_ref_delete', array('id' => $ref->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
