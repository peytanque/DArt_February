<?php

namespace DR\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DR\PlatformBundle\Entity\Type;
use DR\PlatformBundle\Form\TypeType;

/**
 * Type controller.
 *
 * @Route("/type")
 */
class TypeController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('DRPlatformBundle:Type')->findAll();

        return $this->render('DRPlatformBundle:Art:Type/index.html.twig', array(
            'types' => $types,
        ));
    }

    public function newAction(Request $request)
    {
        $type = new Type();
        $form = $this->createForm('DR\PlatformBundle\Form\TypeType', $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('dr_type_show', array('id' => $type->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Type/new.html.twig', array(
            'type' => $type,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Type $type)
    {
        $deleteForm = $this->createDeleteForm($type);

        return $this->render('DRPlatformBundle:Art:Type/show.html.twig', array(
            'type' => $type,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Type $type)
    {
        $deleteForm = $this->createDeleteForm($type);
        $editForm = $this->createForm('DR\PlatformBundle\Form\TypeType', $type);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('dr_type_show', array('id' => $type->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Type/edit.html.twig', array(
            'type' => $type,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Type entity.
     *
     * @Route("/{id}", name="type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Type $type)
    {
        $form = $this->createDeleteForm($type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($type);
            $em->flush();
        }

        return $this->redirectToRoute('dr_type_index');
    }

    /**
     * Creates a form to delete a Type entity.
     *
     * @param Type $type The Type entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Type $type)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dr_type_delete', array('id' => $type->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
