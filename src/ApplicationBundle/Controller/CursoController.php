<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\CicloLectivo;
use ApplicationBundle\Entity\Curso;
use ApplicationBundle\Entity\Materia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Curso controller.
 *
 * @Route("curso")
 */
class CursoController extends Controller
{
    /**
     * Lists all curso entities.
     *
     * @Route("/", name="curso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cursos = $em->getRepository('ApplicationBundle:Curso')->findAll();

        return $this->render('curso/index.html.twig', array(
            'cursos' => $cursos,
        ));
    }

    /**
     * Creates a new curso entity.
     *
     * @Route("/new", name="curso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $curso = new Curso();
        $form = $this->createForm('ApplicationBundle\Form\CursoType', $curso);
        $form->handleRequest($request);
     

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($curso);
            $em->flush();

            return $this->redirectToRoute('curso_show', array('id' => $curso->getId()));
        }

        return $this->render('curso/new.html.twig', array(
            'curso' => $curso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a curso entity.
     *
     * @Route("/{id}", name="curso_show")
     * @Method("GET")
     */
    public function showAction(Curso $curso)
    {
        $deleteForm = $this->createDeleteForm($curso);

        return $this->render('curso/show.html.twig', array(
            'curso' => $curso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing curso entity.
     *
     * @Route("/{id}/edit", name="curso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Curso $curso)
    {
        $deleteForm = $this->createDeleteForm($curso);
        $editForm = $this->createForm('ApplicationBundle\Form\CursoType', $curso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('curso_show', array('id' => $curso->getId()));
        }

        return $this->render('curso/edit.html.twig', array(
            'curso' => $curso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a curso entity.
     *
     * @Route("/{id}", name="curso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Curso $curso)
    {
        $form = $this->createDeleteForm($curso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($curso);
            $em->flush();
        }

        return $this->redirectToRoute('curso_index');
    }

    /**
     * Creates a form to delete a curso entity.
     *
     * @param Curso $curso The curso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Curso $curso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('curso_delete', array('id' => $curso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

     /**
     * Finds and displays a curso entity.
     *
     * @Route("/{id}/agregar", name="curso_agregar")
     * @Method("GET")
     */ 
    public function agregarAction(Curso $curso)
    {

        $em = $this->getDoctrine()->getManager();

        $materias = $em->getRepository('ApplicationBundle:Materia')->findAll();
        $alumnos = $em->getRepository('ApplicationBundle:Alumno')->findAll();

        $db = $em -> getConnection();

        $query = "select * from materia where materia.curso_id =" . $curso->getId(); 
        $stmt = $db -> prepare($query);
        $params = array();
        $stmt -> execute($params);
        $materiasAsignadas = $stmt -> fetchAll();


        $query2 = "select * from alumno where alumno.curso_id =" . $curso->getId(); 
        $stmt = $db -> prepare($query2);
        $params = array();
        $stmt -> execute($params);

        $alumnosAsignados = $stmt -> fetchAll();


        return $this->render('curso/agregarMateria.html.twig', array(
            'curso' => $curso,
            'materias' => $materias,
            'alumnos' => $alumnos,
            'materiasAsignadas' => $materiasAsignadas,
            'alumnosAsignados' => $alumnosAsignados
 
        ));
    }

      /**
     * Finds and displays a curso entity.
     *
     * @Route("/{id}/agregar/{idMateria}", name="curso_agregarMateria")
     * @Method("GET")
     */
    public function agregarMateriaAction(Curso $curso, $idMateria)
    {
        
        $em = $this->getDoctrine()->getManager();
        $db = $em -> getConnection();

        $query = "update materia set curso_id =" . $curso->getId() . " where materia.id =" . $idMateria; 
        $stmt = $db -> prepare($query);
        $params = array();
        $stmt -> execute($params);


/** $materia = $em->getRepository('ApplicationBundle:Materia')->find($idMateria);
        $materia -> setCurso($curso->getId());
        */

        $response = $this -> forward('ApplicationBundle:Curso:agregar' , array('curso' => $curso,));
        return $response;
    }

       /**
     *
     *
     * @Route("/{id}/agregarAlumno/{idAlumno}", name="curso_agregarAlumno")
     * @Method("GET")
     */
    public function agregarAlumnoAction(Curso $curso, $idAlumno)
    {

        $em = $this->getDoctrine()->getManager();
        $db = $em -> getConnection();

        $query = "update alumno set curso_id =" . $curso->getId() . " where alumno.id =" . $idAlumno; 
        $stmt = $db -> prepare($query);
        $params = array();
        $stmt -> execute($params);


        $response = $this -> forward('ApplicationBundle:Curso:agregar' , array('curso' => $curso,));
        return $response;
    }

     /**
     *
     *
     * @Route("/{id}/{opc}/{id2}", name="curso_deshacer")
     * @Method("GET")
     */
    public function deshacerAction(Curso $curso, $id2, $opc)
    {
        

        if ($opc == 'true'){
            $em = $this->getDoctrine()->getManager();
            $db = $em -> getConnection();
            $query = "update alumno set curso_id = NULL where alumno.id =" . $id2; 
            $stmt = $db -> prepare($query);
            $params = array();
            $stmt -> execute($params);
        }

        else if($opc == 'false'){
            $em = $this->getDoctrine()->getManager();
            $db = $em -> getConnection();
            $query = "update materia set curso_id = NULL where materia.id =" . $id2; 
            $stmt = $db -> prepare($query);
            $params = array();
            $stmt -> execute($params);
        };

        $response = $this -> forward('ApplicationBundle:Curso:agregar' , array('curso' => $curso,));
        return $response;
    }

    /**
     *
     *
     * @Route("auto-generar/{id}", name="curso_autogenerar")
     * @Method("GET")
     */

    
    public function autogenerarAction(CicloLectivo $cicloLectivo)
    {
        
        $em = $this->getDoctrine()->getManager();

        $nuevoCicloLectivo = $cicloLectivo;
        $cicloLectivoActivo = $em->getRepository('ApplicationBundle:CicloLectivo')->findOneByActivo(true);
        $cursosAnteriores = $cicloLectivoActivo->getCursos();


        foreach ($cursosAnteriores as $cursoAnterior) {

            $curso = New Curso();
            $curso->setTurno($cursoAnterior->getTurno());
            $curso->setAnio($cursoAnterior->getAnio());
            $curso->setSeccion($cursoAnterior->getSeccion());
            $curso->setCicloLectivo($nuevoCicloLectivo);
            $em->persist($curso);
            $em->flush();
            foreach ($cursoAnterior->getMaterias() as $materia){
                $materiaNueva = new Materia();
                $materiaNueva->setNombre($materia->getNombre());
                $materiaNueva->setCurso($curso);
                $em->persist($materiaNueva);
                $em->flush();
                $curso->addMateria($materiaNueva);   
            }
            $em->persist($curso);
            $em->flush();
            
            //die(dump($curso));
            

            /*$materiasDeCurso = $curso->getMaterias();
            foreach ($materiasDeCurso as $m){
                $m->setCurso($curso);
                $em->flush();
                $curso->addMateria($materiaNueva);
            }*/

        }
        
        #$cursosNuevoCiclo = $em->getRepository('ApplicationBundle:Curso')->findByCiclolectivo($nuevoCicloLectivo);

        $response = $this -> forward('ApplicationBundle:CicloLectivo:show' , array('cicloLectivo'=> $nuevoCicloLectivo,));
        return $response;
            #'cursosNuevoCiclo' => $cursosNuevoCiclo,
            
    }



}

