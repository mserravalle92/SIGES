<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\Asistencia;
use ApplicationBundle\Entity\Curso;
use ApplicationBundle\Entity\Materia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Asistencium controller.
 *
 * @Route("asistencia")
 */
class AsistenciaController extends Controller
{
    /**
     * Lists all asistencium entities.
     *
     * @Route("/{id}", name="asistencia_index")
     * @Method("GET")
     */

    public function indexAction(Curso $curso,Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //FIXME: Sacar el HardCodeo
        //$idMateria = $request->get('idMateria');

        $idMateria = 1;

        $materia = $em->getRepository('ApplicationBundle:Materia')->findOneById($idMateria);

        $alumnos = $em->getRepository("ApplicationBundle:Alumno")->getAlumnosByCurso($curso);

        $tiposAsistencia = $em->getRepository("ApplicationBundle:TipoAsistencia")->findAll();

        return $this->render('asistencia/index.html.twig', array(
            'alumnos'=> $alumnos,
            'materia'=> $materia,
            'tiposAsistencia'=> $tiposAsistencia
        ));
    }

    /**
     * Creates a new asistencium entity.
     *
     * @Route("/new", name="asistencia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $asistencium = new Asistencia();

        $materia = $request->get('materia');
        $alumno = $request->get('alumno');

        $form = $this->createForm('ApplicationBundle\Form\AsistenciaType', $asistencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asistencium);
            $em->flush();

            return $this->redirectToRoute('asistencia_show', array('id' => $asistencium->getId()));
        }

        return $this->render('asistencia/new.html.twig', array(
            'asistencium' => $asistencium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a asistencium entity.
     *
     * @Route("/{id}", name="asistencia_show")
     * @Method("GET")
     */
    public function showAction(Asistencia $asistencium)
    {
        $deleteForm = $this->createDeleteForm($asistencium);

        return $this->render('asistencia/show.html.twig', array(
            'asistencium' => $asistencium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing asistencium entity.
     *
     * @Route("/{id}/edit", name="asistencia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Asistencia $asistencium)
    {
        $deleteForm = $this->createDeleteForm($asistencium);
        $editForm = $this->createForm('ApplicationBundle\Form\AsistenciaType', $asistencium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asistencia_edit', array('id' => $asistencium->getId()));
        }

        return $this->render('asistencia/edit.html.twig', array(
            'asistencium' => $asistencium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a asistencium entity.
     *
     * @Route("/{id}", name="asistencia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Asistencia $asistencium)
    {
        $form = $this->createDeleteForm($asistencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($asistencium);
            $em->flush();
        }

        return $this->redirectToRoute('asistencia_index');
    }

    /**
     * Creates a form to delete a asistencium entity.
     *
     * @param Asistencia $asistencium The asistencium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Asistencia $asistencium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('asistencia_delete', array('id' => $asistencium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     *
     *
     * @Route("/cargar-asistencia", name="cargar_asistencia")
     * @Method("POST")
     */

    public function cargarAsistenciaAction(Request $request){

        $idAlumno = $request->get('idAlumno');
        $idTipo = $request->get('idTipo');
        $idMateria = $request->get('idMateria');

        $em = $this->getDoctrine()->getManager();


        $alumno = $em->getRepository('ApplicationBundle:Alumno')->findOneById($idAlumno);
        $tipo = $em->getRepository('ApplicationBundle:TipoAsistencia')->findOneById($idTipo);
        $materia = $em->getRepository('ApplicationBundle:Materia')->findOneById($idMateria);


        $asistencia = New Asistencia();
        $asistencia->setTipoAsistencia($tipo);
        $asistencia->setAlumno($alumno);
        $asistencia->setMateria($materia);

        $em->persist($asistencia);
        $em->flush();

        $datos = ['alumno'=> $idAlumno,'tipo'=> $tipo->getDescripcion()];
        $response = new Response((json_encode($datos)));
        $response->headers->set('Content-Type', 'application/json');


        return $response;
    }

    /**
     *
     *
     * @Route("/eliminar-asistencia", name="eliminar_asistencia")
     * @Method("POST")
     */

    public function eliminarAsistencia(Request $request){

        $idAlumno = $request->get('idAlumno');
        $idMateria = $request->get('idMateria');

        $em = $this->getDoctrine()->getManager();


        $alumno = $em->getRepository('ApplicationBundle:Alumno')->findOneById($idAlumno);
        $materia = $em->getRepository('ApplicationBundle:Materia')->findOneById($idMateria);





        $asistencias = $em->getRepository('ApplicationBundle:Asistencia')
            ->findBy(['alumno'=>$alumno, 'materia'=> $materia]);


        $this->verificarYEliminarAsistencia($asistencias);

        return new Response($idAlumno);

    }



    public function verificarYEliminarAsistencia($asistencias){

        $em = $this->getDoctrine()->getManager();

        $fechaLarga = new \DateTime();

        $fechaActual = $fechaLarga->format('Y-m-d');

        foreach ($asistencias as $asistencia){

            $fechaLargaAsist = $asistencia->getFechaAlta();
            $fechaAsist = $fechaLargaAsist->format('Y-m-d');

            if ($fechaAsist == $fechaActual){
                $em->remove($asistencia);
                $em->flush();

            }

        }

    }

}

