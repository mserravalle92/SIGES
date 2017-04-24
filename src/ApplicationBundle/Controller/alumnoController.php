<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\alumno;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Alumno controller.
 *
 * @Route("alumno")
 */
class alumnoController extends Controller
{
    /**
     * Lists all alumno entities.
     *
     * @Route("/", name="alumno_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $alumnos = $em->getRepository('ApplicationBundle:alumno')->findAll();

        return $this->render('alumno/index.html.twig', array(
            'alumnos' => $alumnos,
        ));
    }

    /**
     * Creates a new alumno entity.
     *
     * @Route("/new", name="alumno_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $alumno = new Alumno();
        $form = $this->createForm('ApplicationBundle\Form\alumnoType', $alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumno);
            $em->flush();

            return $this->redirectToRoute('alumno_show', array('id' => $alumno->getId()));
        }

        return $this->render('alumno/new.html.twig', array(
            'alumno' => $alumno,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a alumno entity.
     *
     * @Route("/{id}", name="alumno_show")
     * @Method("GET")
     */
    public function showAction(alumno $alumno)
    {
        $deleteForm = $this->createDeleteForm($alumno);

        return $this->render('alumno/show.html.twig', array(
            'alumno' => $alumno,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing alumno entity.
     *
     * @Route("/{id}/edit", name="alumno_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, alumno $alumno)
    {
        $deleteForm = $this->createDeleteForm($alumno);
        $editForm = $this->createForm('ApplicationBundle\Form\alumnoType', $alumno);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alumno_edit', array('id' => $alumno->getId()));
        }

        return $this->render('alumno/edit.html.twig', array(
            'alumno' => $alumno,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a alumno entity.
     *
     * @Route("/{id}", name="alumno_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, alumno $alumno)
    {
        $form = $this->createDeleteForm($alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alumno);
            $em->flush();
        }

        return $this->redirectToRoute('alumno_index');
    }

    /**
     * Creates a form to delete a alumno entity.
     *
     * @param alumno $alumno The alumno entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(alumno $alumno)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumno_delete', array('id' => $alumno->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
