<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\AlumnoExamen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * AlumnoExamen controller.
 *
 * @Route("alumnoexamen")
 */
class AlumnoExamenController extends Controller
{
    /**
     * Lists all alumnoExamen entities.
     *
     * @Route("/", name="alumnoexamen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $alumnoExamens = $em->getRepository('ApplicationBundle:AlumnoExamen')->findAll();

        return $this->render('alumnoexamen/index.html.twig', array(
            'alumnoExamens' => $alumnoExamens,
        ));
    }

    /**
     * Creates a new alumnoExamen entity.
     *
     * @Route("/new", name="alumnoexamen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $alumnoExamen = new Alumnoexamen();
        $form = $this->createForm('ApplicationBundle\Form\AlumnoExamenType', $alumnoExamen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumnoExamen);
            $em->flush();

            return $this->redirectToRoute('alumnoexamen_show', array('id' => $alumnoExamen->getId()));
        }

        return $this->render('alumnoexamen/new.html.twig', array(
            'alumnoExamen' => $alumnoExamen,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a alumnoExamen entity.
     *
     * @Route("/{id}", name="alumnoexamen_show")
     * @Method("GET")
     */
    public function showAction(AlumnoExamen $alumnoExamen)
    {
        $deleteForm = $this->createDeleteForm($alumnoExamen);

        return $this->render('alumnoexamen/show.html.twig', array(
            'alumnoExamen' => $alumnoExamen,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing alumnoExamen entity.
     *
     * @Route("/{id}/edit", name="alumnoexamen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AlumnoExamen $alumnoExamen)
    {
        $deleteForm = $this->createDeleteForm($alumnoExamen);
        $editForm = $this->createForm('ApplicationBundle\Form\AlumnoExamenType', $alumnoExamen);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alumnoexamen_edit', array('id' => $alumnoExamen->getId()));
        }

        return $this->render('alumnoexamen/edit.html.twig', array(
            'alumnoExamen' => $alumnoExamen,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a alumnoExamen entity.
     *
     * @Route("/{id}", name="alumnoexamen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AlumnoExamen $alumnoExamen)
    {
        $form = $this->createDeleteForm($alumnoExamen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alumnoExamen);
            $em->flush();
        }

        return $this->redirectToRoute('alumnoexamen_index');
    }

    /**
     * Creates a form to delete a alumnoExamen entity.
     *
     * @param AlumnoExamen $alumnoExamen The alumnoExamen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AlumnoExamen $alumnoExamen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumnoexamen_delete', array('id' => $alumnoExamen->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
