<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\PersonalDocente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Personaldocente controller.
 *
 * @Route("personaldocente")
 */
class PersonalDocenteController extends Controller
{
    /**
     * Lists all personalDocente entities.
     *
     * @Route("/", name="personaldocente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $personalDocentes = $em->getRepository('ApplicationBundle:PersonalDocente')->findAll();

        return $this->render('personaldocente/index.html.twig', array(
            'personalDocentes' => $personalDocentes,
        ));
    }

    /**
     * Creates a new personalDocente entity.
     *
     * @Route("/new", name="personaldocente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $personalDocente = new Personaldocente();
        $form = $this->createForm('ApplicationBundle\Form\PersonalDocenteType', $personalDocente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personalDocente);
            $em->flush();

            return $this->redirectToRoute('personaldocente_show', array('id' => $personalDocente->getId()));
        }

        return $this->render('personaldocente/new.html.twig', array(
            'personalDocente' => $personalDocente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a personalDocente entity.
     *
     * @Route("/{id}", name="personaldocente_show")
     * @Method("GET")
     */
    public function showAction(PersonalDocente $personalDocente)
    {
        $deleteForm = $this->createDeleteForm($personalDocente);

        return $this->render('personaldocente/show.html.twig', array(
            'personalDocente' => $personalDocente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing personalDocente entity.
     *
     * @Route("/{id}/edit", name="personaldocente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PersonalDocente $personalDocente)
    {
        $deleteForm = $this->createDeleteForm($personalDocente);
        $editForm = $this->createForm('ApplicationBundle\Form\PersonalDocenteType', $personalDocente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personaldocente_edit', array('id' => $personalDocente->getId()));
        }

        return $this->render('personaldocente/edit.html.twig', array(
            'personalDocente' => $personalDocente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a personalDocente entity.
     *
     * @Route("/{id}", name="personaldocente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PersonalDocente $personalDocente)
    {
        $form = $this->createDeleteForm($personalDocente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($personalDocente);
            $em->flush();
        }

        return $this->redirectToRoute('personaldocente_index');
    }

    /**
     * Creates a form to delete a personalDocente entity.
     *
     * @param PersonalDocente $personalDocente The personalDocente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PersonalDocente $personalDocente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personaldocente_delete', array('id' => $personalDocente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
