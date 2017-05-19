<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\CicloLectivo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ciclolectivo controller.
 *
 * @Route("ciclolectivo")
 */
class CicloLectivoController extends Controller
{
    /**
     * Lists all cicloLectivo entities.
     *
     * @Route("/", name="ciclolectivo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cicloLectivos = $em->getRepository('ApplicationBundle:CicloLectivo')->findAll();

          $db = $em -> getConnection();

        $query = "select * from cicloLectivo where activo = 1;";
        
        $stmt = $db -> prepare($query);
        
        $params = array();
        $stmt -> execute($params);
        

        $po = $stmt -> fetchAll();

        #die(dump($po));

            # code... 
        

        return $this->render('ciclolectivo/index.html.twig', array(
            'cicloLectivos' => $cicloLectivos,
            'ultimoCiclo' => $po,

        ));

    }

    /**
     * Creates a new cicloLectivo entity.
     *
     * @Route("/new", name="ciclolectivo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cicloLectivo = new Ciclolectivo();
        $form = $this->createForm('ApplicationBundle\Form\CicloLectivoType', $cicloLectivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cicloLectivo);
            $em->flush();

            return $this->redirectToRoute('ciclolectivo_show', array('id' => $cicloLectivo->getId()));
        }

        return $this->render('ciclolectivo/new.html.twig', array(
            'cicloLectivo' => $cicloLectivo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cicloLectivo entity.
     *
     * @Route("/{id}", name="ciclolectivo_show")
     * @Method("GET")
     */
    public function showAction(CicloLectivo $cicloLectivo)
    {
        $deleteForm = $this->createDeleteForm($cicloLectivo);

        return $this->render('ciclolectivo/show.html.twig', array(
            'cicloLectivo' => $cicloLectivo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cicloLectivo entity.
     *
     * @Route("/{id}/edit", name="ciclolectivo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CicloLectivo $cicloLectivo)
    {
        $deleteForm = $this->createDeleteForm($cicloLectivo);
        $editForm = $this->createForm('ApplicationBundle\Form\CicloLectivoType', $cicloLectivo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ciclolectivo_show', array('id' => $cicloLectivo->getId()));
        }

        return $this->render('ciclolectivo/edit.html.twig', array(
            'cicloLectivo' => $cicloLectivo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cicloLectivo entity.
     *
     * @Route("/{id}", name="ciclolectivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CicloLectivo $cicloLectivo)
    {
        $form = $this->createDeleteForm($cicloLectivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cicloLectivo);
            $em->flush();
        }

        return $this->redirectToRoute('ciclolectivo_index');
    }

    /**
     * Creates a form to delete a cicloLectivo entity.
     *
     * @param CicloLectivo $cicloLectivo The cicloLectivo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CicloLectivo $cicloLectivo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ciclolectivo_delete', array('id' => $cicloLectivo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     *  a cicloLectivo entity.
     *
     * @Route("/{id}/{activo}", name="ciclolectivo_activar")
     *
     */
    public function activarAction(CicloLectivo $cicloLectivo, $activo)
    {
        $em = $this->getDoctrine()->getManager();
        $ciclosActivos = $em->getRepository('ApplicationBundle:CicloLectivo')->findByActivo(true);
        if ($activo == 'activar') {
            if (count($ciclosActivos) == 0){
               //$cicloLectivo = $em->getRepository('ApplicationBundle:CicloLectivo')->findBy($cicloLectivo);
               $cicloLectivo->setActivo(1);
               $em->persist($cicloLectivo);
                $em->flush();
            }
            else{ 
                return $this->redirectToRoute('ciclolectivo_index');
            }
        }

        if ($activo == 'desactivar'){
            //print_r($cicloLectivo);
            //$cicloLectivo = $em->getRepository('ApplicationBundle:CicloLectivo')->findOneBy($cicloLectivo);
            $cicloLectivo->setActivo(0);

            $em->persist($cicloLectivo);
            $em->flush();
        }

        return $this->redirectToRoute('ciclolectivo_show', array('id' => $cicloLectivo->getId()));
     
    }
}
