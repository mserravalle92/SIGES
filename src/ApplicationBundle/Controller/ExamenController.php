<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\Examen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Examen controller.
 *
 * @Route("examen")
 */
class ExamenController extends Controller
{
    /**
     * Lists all examen entities.
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
     * Creates a new examen entity.
     *
     * @Route("/new", name="examen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $examen = new Examen();
        $form = $this->createForm('ApplicationBundle\Form\ExamenType', $examen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($examen);
            $em->flush();

            return $this->redirectToRoute('examen_show', array('id' => $examen->getId()));
        }

        return $this->render('examen/new.html.twig', array(
            'examen' => $examen,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a examen entity.
     *
     * @Route("/{id}", name="examen_show")
     * @Method("GET")
     */
    public function showAction(Examen $examen)
    {
        $deleteForm = $this->createDeleteForm($examen);

        return $this->render('examen/show.html.twig', array(
            'examen' => $examen,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing examen entity.
     *
     * @Route("/{id}/edit", name="examen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Examen $examen)
    {
        $deleteForm = $this->createDeleteForm($examen);
        $editForm = $this->createForm('ApplicationBundle\Form\ExamenType', $examen);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('examen_edit', array('id' => $examen->getId()));
        }

        return $this->render('examen/edit.html.twig', array(
            'examen' => $examen,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a examen entity.
     *
     * @Route("/{id}", name="examen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Examen $examen)
    {
        $form = $this->createDeleteForm($examen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($examen);
            $em->flush();
        }

        return $this->redirectToRoute('examen_index');
    }

    /**
     * Creates a form to delete a examen entity.
     *
     * @param Examen $examen The examen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Examen $examen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('examen_delete', array('id' => $examen->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
