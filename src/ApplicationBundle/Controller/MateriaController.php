<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\Materia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Materium controller.
 *
 * @Route("materias")
 */
class MateriaController extends Controller
{
    /**
     * Lists all materium entities.
     *
     * @Route("/", name="materia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $materias = $em->getRepository('ApplicationBundle:Materia')->findAll();

        return $this->render('materia/index.html.twig', array(
            'materias' => $materias,
        ));
    }

    /**
     * Creates a new materium entity.
     *
     * @Route("/new", name="materia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $materium = new Materium();
        $form = $this->createForm('ApplicationBundle\Form\MateriaType', $materium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materium);
            $em->flush();

            return $this->redirectToRoute('materia_show', array('id' => $materium->getId()));
        }

        return $this->render('materia/new.html.twig', array(
            'materium' => $materium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a materium entity.
     *
     * @Route("/{id}", name="materia_show")
     * @Method("GET")
     */
    public function showAction(Materia $materium)
    {
        $deleteForm = $this->createDeleteForm($materium);

        return $this->render('materia/show.html.twig', array(
            'materium' => $materium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing materium entity.
     *
     * @Route("/{id}/edit", name="materia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Materia $materium)
    {
        $deleteForm = $this->createDeleteForm($materium);
        $editForm = $this->createForm('ApplicationBundle\Form\MateriaType', $materium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materia_edit', array('id' => $materium->getId()));
        }

        return $this->render('materia/edit.html.twig', array(
            'materium' => $materium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a materium entity.
     *
     * @Route("/{id}", name="materia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Materia $materium)
    {
        $form = $this->createDeleteForm($materium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($materium);
            $em->flush();
        }

        return $this->redirectToRoute('materia_index');
    }

    /**
     * Creates a form to delete a materium entity.
     *
     * @param Materia $materium The materium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Materia $materium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materia_delete', array('id' => $materium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
