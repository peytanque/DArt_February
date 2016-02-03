<?php

namespace DR\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DR\PlatformBundle\Entity\Area;
use DR\PlatformBundle\Form\AreaType;

/**
 * Area controller.
 *
 * @Route("/area")
 */
class AreaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $areas = $em->getRepository('DRPlatformBundle:Area')->findAll();

        return $this->render('DRPlatformBundle:Art:Area/index.html.twig', array(
            'areas' => $areas,
        ));
    }

    public function newAction(Request $request)
    {
        $area = new Area();
        $form = $this->createForm('DR\PlatformBundle\Form\AreaType', $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('dr_area_show', array('id' => $area->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Area/new.html.twig', array(
            'area' => $area,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Area $area)
    {
        $deleteForm = $this->createDeleteForm($area);

        return $this->render('DRPlatformBundle:Art:Area/show.html.twig', array(
            'area' => $area,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Area $area)
    {
        $deleteForm = $this->createDeleteForm($area);
        $editForm = $this->createForm('DR\PlatformBundle\Form\AreaType', $area);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('dr_area_edit', array('id' => $area->getId()));
        }

        return $this->render('DRPlatformBundle:Art:Area/edit.html.twig', array(
            'area' => $area,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Area $area)
    {
        $form = $this->createDeleteForm($area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($area);
            $em->flush();
        }

        return $this->redirectToRoute('dr_area_index');
    }

    /**
     * Creates a form to delete a Area entity.
     *
     * @param Area $area The Area entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Area $area)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dr_area_delete', array('id' => $area->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
