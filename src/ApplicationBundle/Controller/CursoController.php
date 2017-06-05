<?php

namespace ApplicationBundle\Controller;


use ApplicationBundle\Entity\Alumno;
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

        $cicloActivo = $em->getRepository('ApplicationBundle:CicloLectivo')->findOneBy(['activo'=>true]);


        $cursos = $em->getRepository('ApplicationBundle:Curso')->findByCiclolectivo($cicloActivo);


        return $this->render('curso/index.html.twig', array('cursos' => $cursos));       
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

       /* $query2 = "select * from alumno inner join alumno_curso on(curso_id =" . $curso->getId() .")"; 
        $stmt = $db -> prepare($query2);
        $params = array();
        $stmt -> execute($params);*/
        $alumnosAsignados = $curso->getAlumnos();
        $materiasAsignadas=$curso->getMaterias();

        return $this->render('curso/agregar.html.twig', array(
            'curso' => $curso,
            'materias' => $materias,
            'alumnos' => $alumnos,
            'materiasAsignadas' => $materiasAsignadas,
            'alumnosAsignados' => $alumnosAsignados
 
        ));
    }



     /**
     *
     *
     * @Route("/{id}/buscarMat", name="curso_buscarMat")
     * @Method("GET")
     */
    public function buscarMAction(Curso $curso)
    {
        $materia='null';
        return $this->render('curso/buscarMateria.html.twig' , array('curso' => $curso, 'materia' => $materia));
    }


       /**
     *
     *
     * @Route("/{id}/buscarMateria/", name="curso_buscarMateria")
     * @Method({"GET", "POST"})
     */
    public function buscarMateriaAction(Curso $curso, Request $request)
    {

        $nombreMateria =$request->get('materia');

        $em = $this->getDoctrine()->getManager();
        $materia = $em->getRepository('ApplicationBundle:Materia')->findOneByNombre($nombreMateria);
        
        return $this->render('curso/buscarMateria.html.twig', array(
            'materia' => $materia, 'curso' => $curso)
        );
    }


      /**
     * Finds and displays a curso entity.
     *
     * @Route("/{id}/agregar/{idMateria}", name="curso_agregarMateria")
     * @Method("GET")
     */
    public function agregarMateriaAction(Curso $curso, Request $request)
    {

        $idMateria= $request->get('idMateria');
        $em = $this->getDoctrine()->getManager();
        $db = $em -> getConnection();
        $curso->addMateria($idMateria);
        $em->persist($curso);
        $em->flush();
 
        $response = $this -> forward('ApplicationBundle:Curso:agregar' , array('curso' => $curso));
        return $response;

    }

     /**
     *
     *
     * @Route("/auto-agregar-materia/{id}", name="curso_autogenerarMateria")
     * @Method("GET")
     */
    public function autogenerarMateriaAction(Curso $curso, Request $request)
    {
        #la vista se muestra bien, pero cuando se manda la materia a esta accion se muestra un error y el dump no llega a ejecutarse
        $idMateria= $request->get('idMateria');
        $em = $this->getDoctrine()->getManager();

        $curso = $em->getRepository('ApplicationBundle:Curso')->findOneById($curso);
        $materia = $em->getRepository('ApplicationBundle:Materia')->findOneById($idMateria); 

        $curso->addMateria($materia);
        $em->persist($curso);
        $em->flush();


         $response = $this -> forward('ApplicationBundle:Curso:agregarMateria' ,
         array('curso' => $curso, 'idMateria' => $materia));
        return $response;

         } 
        
    


 /**
     *
     *
     * @Route("/{id}/buscar", name="curso_buscar")
     * @Method("GET")
     */
    public function buscarAction(Curso $curso)
    {
        $alumno='null';
        return $this->render('curso/buscarAlumno.html.twig' , array('curso' => $curso, 'alumno' => $alumno,));
    }

     /**
     *
     *
     * @Route("/{id}/buscarAlumno/", name="curso_buscarAlumno")
     * @Method({"GET", "POST"})
     */
    public function buscarAlumnoAction(Curso $curso, Request $request)
    {

        $dniAlumno =$request->get('dni');
        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('ApplicationBundle:Alumno')->findOneByDni((int)$dniAlumno);
      
        return $this->render('curso/buscarAlumno.html.twig', array(
            'alumno' => $alumno, 'curso' => $curso)
        );
    }



       /**
     * Finds and displays a curso entity.
     *
     * @Route("/{id}/agregar/{idAlumno}", name="curso_agregarAlumno")
     * @Method("GET")
     */
    public function agregarAlumnoAction(Curso $curso, Alumno $idAlumno)
    {
        $em = $this->getDoctrine()->getManager();
        $db = $em -> getConnection();

        $idAlumno->addCurso($curso);
        $curso->addAlumno($idAlumno);



        $response = $this -> forward('ApplicationBundle:Curso:agregar' , array('curso' => $curso));
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
        
        //FIXME: Refactorizar el código orientado a objetos no SQL

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


        /*-----SI NO HAY NINGUN ACTIVO NO SE PUEDE AUTOGENERAR CURSOS*/
        if($cicloLectivoActivo == NULL ){

            $this->addFlash('mensaje1','NO SE PUDO AUTOGENERAR LOS CURSOS. REVISE QUE HAYA ALGUN CICLO LECTIVO ACTIVO Y QUE EL MISMO TENGA ASIGNADO LOS CURSOS PARA AUTO-GENERAR');

             $response = $this -> forward('ApplicationBundle:CicloLectivo:show',array('cicloLectivo' => $nuevoCicloLectivo));
        return $response;
        }
       

        $cursosAnteriores = $cicloLectivoActivo->getCursos();
        /*-----SI HAY CICLO ACTIVO PERO NO TIENE CURSOS NO SE PUEDE AUTOGENERAR CURSOS*/
        if(count($cicloLectivoActivo->getCursos()) == 0){
            $this->addFlash('mensaje2',"EL CICLO LECTIVO ACTIVO NO POSEE CURSOS. POR FAVOR REVISE REVISE QUE ESTOS EXISTAN");
             $response = $this -> forward('ApplicationBundle:CicloLectivo:show' , array('cicloLectivo' => $nuevoCicloLectivo));
        return $response;
        }


        /*-----SI HAY ACTIVO Y TIENE CURSOS ASIGNADOS, SE HACE UNA COPIA DE LOS MISMOS*/
        else{

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

                }
            }

           $response = $this -> forward('ApplicationBundle:CicloLectivo:show' , array('cicloLectivo' => $nuevoCicloLectivo));
        return $response;
            
    }



}

