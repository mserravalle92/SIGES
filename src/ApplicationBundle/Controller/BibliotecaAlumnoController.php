<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\BibliotecaAlumno;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ApplicationBundle\Entity\Materia;

/**
 * Bibliotecaalumno controller.
 *
 * @Route("biblioteca")
 */
class BibliotecaAlumnoController extends Controller
{
    /**
     * Lists all bibliotecaAlumno entities.
     *
     * @Route("/{id}", name="biblioteca_index")
     * @Method("GET")
     */
    public function indexAction(Materia $materia)
    {
        $em = $this->getDoctrine()->getManager();

        $bibliotecaAlumno= $em->getRepository('ApplicationBundle:BibliotecaAlumno')->findOneByMateria($materia);

        if (!empty($bibliotecaAlumno)) {
            $posts = $bibliotecaAlumno->getPosts();
        }else{
            $posts = [];
        }


        return $this->render('bibliotecaalumno/index.html.twig', array(
            'bibliotecaAlumno' => $bibliotecaAlumno,
            'materia' => $materia,
            'posts' => $posts
        ));
    }

    /**
     * Creates a new bibliotecaAlumno entity.
     *
     * @Route("/new", name="biblioteca_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bibliotecaAlumno = new Bibliotecaalumno();
        $form = $this->createForm('ApplicationBundle\Form\BibliotecaAlumnoType', $bibliotecaAlumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bibliotecaAlumno);
            $em->flush();

            return $this->redirectToRoute('biblioteca_show', array('id' => $bibliotecaAlumno->getId()));
        }

        return $this->render('bibliotecaalumno/new.html.twig', array(
            'bibliotecaAlumno' => $bibliotecaAlumno,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bibliotecaAlumno entity.
     *
     *
     */
    public function showAction(BibliotecaAlumno $bibliotecaAlumno)
    {
        $deleteForm = $this->createDeleteForm($bibliotecaAlumno);

        return $this->render('bibliotecaalumno/show.html.twig', array(
            'bibliotecaAlumno' => $bibliotecaAlumno,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bibliotecaAlumno entity.
     *
     * @Route("/{id}/edit", name="biblioteca_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BibliotecaAlumno $bibliotecaAlumno)
    {
        $deleteForm = $this->createDeleteForm($bibliotecaAlumno);
        $editForm = $this->createForm('ApplicationBundle\Form\BibliotecaAlumnoType', $bibliotecaAlumno);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('biblioteca_edit', array('id' => $bibliotecaAlumno->getId()));
        }

        return $this->render('bibliotecaalumno/edit.html.twig', array(
            'bibliotecaAlumno' => $bibliotecaAlumno,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bibliotecaAlumno entity.
     *
     * @Route("/{id}", name="biblioteca_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BibliotecaAlumno $bibliotecaAlumno)
    {
        $form = $this->createDeleteForm($bibliotecaAlumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bibliotecaAlumno);
            $em->flush();
        }

        return $this->redirectToRoute('biblioteca_index');
    }

    /**
     * Creates a form to delete a bibliotecaAlumno entity.
     *
     * @param BibliotecaAlumno $bibliotecaAlumno The bibliotecaAlumno entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BibliotecaAlumno $bibliotecaAlumno)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('biblioteca_delete', array('id' => $bibliotecaAlumno->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
