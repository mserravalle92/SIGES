<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\Alumno;
use ApplicationBundle\Entity\Tutor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Alumno controller.
 *
 * @Route("alumno")
 */
class AlumnoController extends Controller
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

        $alumnos = $em->getRepository('ApplicationBundle:Alumno')->findAll();

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
        $form = $this->createForm('ApplicationBundle\Form\AlumnoType', $alumno);
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
    public function showAction(Alumno $alumno)
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
    public function editAction(Request $request, Alumno $alumno)
    {
        $deleteForm = $this->createDeleteForm($alumno);
        $editForm = $this->createForm('ApplicationBundle\Form\AlumnoType', $alumno);
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
    public function deleteAction(Request $request, Alumno $alumno)
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
     * @param Alumno $alumno The alumno entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Alumno $alumno)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumno_delete', array('id' => $alumno->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

     /**
      * Finds and displays a alumno entity.
      *
      * @Route("/{id}/agregar", name="alumno_agregar")
      * @Method("GET")
      */ 
    public function agregarAction(Alumno $alumno)
    {
        $em = $this->getDoctrine()->getManager();

          $tutores = $alumno->getTutores();
        
        $db = $em -> getConnection();

        /* $query = "select * from alumnos_tutores where alumno_id =" . $alumno->getId(); 
        $stmt = $db -> prepare($query);
        $params = array();
        $stmt -> execute($params);
        $tutoresAsignados = $stmt -> fetchAll(); */


        return $this->render('alumno/agregarTutor.html.twig', array(
            'alumno' => $alumno,
            'tutores' => $tutores,
 
        ));
    }

   /**
     * Finds and displays a alumno entity.
     *
     * @Route("/{id}/agregar", name="alumno_agregarTutor")
     * @Method("GET")
     */
    public function agregarTutorAction(Alumno $alumno)
    {
        
        $em = $this->getDoctrine()->getManager();
        $db = $em -> getConnection();

        $query = "insert into alumnos_tutores set alumno_id =" . $alumno->getId() . " where tutor_id =" . $idTutor; 
        $stmt = $db -> prepare($query);
        $params = array();
        $stmt -> execute($params);

        $response = $this -> forward('ApplicationBundle:Alumno:agregar' , array('alumno' => $alumno,));
        return $response;
    }

    /**
     *
     *
     * @Route("/{id}/{opc}/{id2}", name="alumno_deshacer")
     * @Method("GET")
     */
    public function deshacerAction(Alumno $alumno, $id2, $opc)
    {
         if($opc == 'true'){
            $em = $this->getDoctrine()->getManager();
            $db = $em -> getConnection();
            $query = "update alumnos_tutores set alumno.id = NULL where tutor.id =" . $id2; 
            $stmt = $db -> prepare($query);
            $params = array();
            $stmt -> execute($params);
        };

        $response = $this -> forward('ApplicationBundle:Alumno:agregar' , array('alumno' => $alumno,));
        return $response;
    }

}
