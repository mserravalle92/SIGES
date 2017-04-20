<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\Examen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Examan controller.
 *
 * @Route("examen")
 */
class ExamenController extends Controller
{
    /**
     * Lists all examan entities.
     *
     * @Route("/", name="examen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $examens = $em->getRepository('ApplicationBundle:Examen')->findAll();

        return $this->render('examen/index.html.twig', array(
            'examens' => $examens,
        ));
    }

    /**
     * Creates a new examan entity.
     *
     * @Route("/new", name="examen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $examan = new Examan();
        $form = $this->createForm('ApplicationBundle\Form\ExamenType', $examan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($examan);
            $em->flush();

            return $this->redirectToRoute('examen_show', array('id' => $examan->getId()));
        }

        return $this->render('examen/new.html.twig', array(
            'examan' => $examan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a examan entity.
     *
     * @Route("/{id}", name="examen_show")
     * @Method("GET")
     */
    public function showAction(Examen $examan)
    {
        $deleteForm = $this->createDeleteForm($examan);

        return $this->render('examen/show.html.twig', array(
            'examan' => $examan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing examan entity.
     *
     * @Route("/{id}/edit", name="examen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Examen $examan)
    {
        $deleteForm = $this->createDeleteForm($examan);
        $editForm = $this->createForm('ApplicationBundle\Form\ExamenType', $examan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('examen_edit', array('id' => $examan->getId()));
        }

        return $this->render('examen/edit.html.twig', array(
            'examan' => $examan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a examan entity.
     *
     * @Route("/{id}", name="examen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Examen $examan)
    {
        $form = $this->createDeleteForm($examan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($examan);
            $em->flush();
        }

        return $this->redirectToRoute('examen_index');
    }

    /**
     * Creates a form to delete a examan entity.
     *
     * @param Examen $examan The examan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Examen $examan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('examen_delete', array('id' => $examan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
