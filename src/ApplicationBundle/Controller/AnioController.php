<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\Anio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Anio controller.
 *
 * @Route("anio")
 */
class AnioController extends Controller
{
    /**
     * Lists all anio entities.
     *
     * @Route("/", name="anio_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)

    {
        $em = $this->getDoctrine()->getManager();
        $anio = new Anio();
        $anios = $em->getRepository('ApplicationBundle:Anio')->findAll();

        $form = $this->createForm('ApplicationBundle\Form\AnioType', $anio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($anio);
            $em->flush();

            return $this->redirectToRoute('anio/index.html.twig', array('anios' => $anios,
            'anio' => $anio,
            'form' => $form->createView()));
        }

        return $this->render('anio/index.html.twig', array('anios' => $anios,  'form' => $form->createView()));
    }

    /**
     * Creates a new anio entity.
     *
     * @Route("/new", name="anio_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $anio = new Anio();
        $form = $this->createForm('ApplicationBundle\Form\AnioType', $anio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($anio);
            $em->flush();

            return $this->redirectToRoute('anio_show', array('id' => $anio->getId()));
        }

        return $this->render('anio/new.html.twig', array(
            'anio' => $anio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a anio entity.
     *
     * @Route("/{id}", name="anio_show")
     * @Method("GET")
     */
    public function showAction(Anio $anio)
    {
        $deleteForm = $this->createDeleteForm($anio);

        return $this->render('anio/show.html.twig', array(
            'anio' => $anio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing anio entity.
     *
     * @Route("/{id}/edit", name="anio_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Anio $anio)
    {
        $deleteForm = $this->createDeleteForm($anio);
        $editForm = $this->createForm('ApplicationBundle\Form\AnioType', $anio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('anio_edit', array('id' => $anio->getId()));
        }

        return $this->render('anio/edit.html.twig', array(
            'anio' => $anio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a anio entity.
     *
     * @Route("/{id}", name="anio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Anio $anio)
    {
        $form = $this->createDeleteForm($anio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($anio);
            $em->flush();
        }

        return $this->redirectToRoute('anio_index');
    }

    /**
     * Creates a form to delete a anio entity.
     *
     * @param Anio $anio The anio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Anio $anio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('anio_delete', array('id' => $anio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
