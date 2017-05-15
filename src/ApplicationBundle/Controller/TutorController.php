<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\Tutor;
use ApplicationBundle\Entity\Alumno;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tutor controller.
 *
 * @Route("tutor")
 */
class TutorController extends Controller
{
    /**
     * Lists all tutor entities.
     *
     * @Route("/", name="tutor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tutors = $em->getRepository('ApplicationBundle:Tutor')->findAll();

        return $this->render('tutor/index.html.twig', array(
            'tutors' => $tutors,
        ));
    }

    /**
     * Creates a new tutor entity.
     *
     * @Route("/newAction", name="tutor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tutor = new Tutor();
        $form = $this->createForm('ApplicationBundle\Form\TutorType', $tutor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tutor);
            $em->flush();

            return $this->redirectToRoute('tutor_show', array('id' => $tutor->getId()));
        }

        return $this->render('tutor/new.html.twig', array(
            'tutor' => $tutor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tutor entity.
     *
     * @Route("/{id}", name="tutor_show")
     * @Method("GET")
     */
    public function showAction(Tutor $tutor)
    {
        $deleteForm = $this->createDeleteForm($tutor);

        return $this->render('tutor/show.html.twig', array(
            'tutor' => $tutor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tutor entity.
     *
     * @Route("/{id}/edit", name="tutor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tutor $tutor)
    {
        $deleteForm = $this->createDeleteForm($tutor);
        $editForm = $this->createForm('ApplicationBundle\Form\TutorType', $tutor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tutor_edit', array('id' => $tutor->getId()));
        }

        return $this->render('tutor/edit.html.twig', array(
            'tutor' => $tutor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tutor entity.
     *
     * @Route("/{id}", name="tutor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tutor $tutor)
    {
        $form = $this->createDeleteForm($tutor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tutor);
            $em->flush();
        }

        return $this->redirectToRoute('tutor_index');
    }

    /**
     * Creates a form to delete a tutor entity.
     *
     * @param Tutor $tutor The tutor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tutor $tutor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tutor_delete', array('id' => $tutor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

     /**
     * Creates a new tutor entity.
     *
     * @Route("/new/{id}", name="tutor_newAlumnoTutor")
     * @Method({"GET", "POST"})
     */
    public function newAlumnoTutorAction(Request $request, Alumno $alumno)
    {
        $tutor = new Tutor();
        $form = $this->createForm('ApplicationBundle\Form\TutorType', $tutor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $alumno->addTutore($tutor);

            $em = $this->getDoctrine()->getManager();
            $em->persist($tutor);
            $em->persist($alumno);

            $em->flush();
            
            return $this->redirectToRoute('tutor_show', array('id' => $tutor->getId()));
        }

        return $this->render('tutor/new.html.twig', array(
            'tutor' => $tutor,
            'form' => $form->createView(),
        ));
    }
}
