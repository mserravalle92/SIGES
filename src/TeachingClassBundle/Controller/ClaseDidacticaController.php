<?php

namespace TeachingClassBundle\Controller;

use TeachingClassBundle\Entity\ClaseDidactica;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TeachingClassBundle\Entity\AuditoriaClaseDidactica;

/**
 * Clasedidactica controller.
 *
 * @Route("clase/didactica")
 */
class ClaseDidacticaController extends Controller
{
    /**
     * Lists all claseDidactica entities.
     *
     * @Route("/", name="clase_didactica_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clasesDidacticas = $em->getRepository('TeachingClassBundle:ClaseDidactica')->findAll();
        return $this->render('clasedidactica/index.html.twig', array(
            'clasesDidacticas' => $clasesDidacticas,
        ));
    }

    /**
     * Creates a new claseDidactica entity.
     *
     * @Route("/new", name="clase_didactica_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newAction(Request $request)
    {
        $claseDidactica = new Clasedidactica();
        $form = $this->createForm('TeachingClassBundle\Form\ClaseDidacticaType', $claseDidactica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager('claseDidactica');

            $materia = $em->getRepository('TeachingClassBundle:Materia')->findOneById($request->get('materia'));
            $estado =   $em->getRepository('TeachingClassBundle:Estado')->findOneById(1);

            $claseDidactica->setHora(new \DateTime('now'));
            $claseDidactica->setEstado($estado);
            $claseDidactica->setUsuarioId($this->getUser()->getId());
            $claseDidactica->setMateria($materia);

            $em->persist($claseDidactica);
            $em->flush();

            return $this->redirectToRoute('clase_didactica_inicio', array('id' => $claseDidactica->getMateria()->getId()));
        }

        return $this->render('TeachingClassBundle:clasedidactica:new.html.twig', array(
            'claseDidactica' => $claseDidactica,
            'form' => $form->createView(),
            'materia' => $request->get('materia'),
        ));
    }



    /**
     * Displays a form to edit an existing claseDidactica entity.
     *
     * @Route("/{id}/edit", name="clase_didactica_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ClaseDidactica $claseDidactica)
    {
        $deleteForm = $this->createDeleteForm($claseDidactica);
        $editForm = $this->createForm('TeachingClassBundle\Form\ClaseDidacticaType', $claseDidactica);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clase_didactica_edit', array('id' => $claseDidactica->getId()));
        }

        return $this->render('clasedidactica/edit.html.twig', array(
            'claseDidactica' => $claseDidactica,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a claseDidactica entity.
     *
     * @Route("/{id}", name="clase_didactica_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ClaseDidactica $claseDidactica)
    {
        $form = $this->createDeleteForm($claseDidactica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($claseDidactica);
            $em->flush();
        }

        return $this->redirectToRoute('clase_didactica_index');
    }

    /**
     * Creates a form to delete a claseDidactica entity.
     *
     * @param ClaseDidactica $claseDidactica The claseDidactica entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ClaseDidactica $claseDidactica)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clase_didactica_delete', array('id' => $claseDidactica->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Deletes a claseDidactica entity.
     *
     * @Route("/iniciar/{id}", name="clase_didactica_iniciar")
     * @Method("GET")
     */

     public function iniciarAction(ClaseDidactica $clase){

      $codigo = $this->generarCodigo($clase);

      $em = $this->getDoctrine()->getManager('claseDidactica');

      $clase->setClaveAcceso($codigo);

      $this->generarAuditoria($clase);

      $em->persist($clase);

      $em->flush();

      return $this->render('TeachingClassBundle:clasedidactica:clase.html.twig' , ['clase'=>$clase]);



     }

     /**
      * Deletes a claseDidactica entity.
      *
      * @Route("/actuaizar/codigo", name="actualizar_codigo_clase")
      * @Method("POST")
      */
      public function cambiarCodigoAction(Request $request)
      {

        $em = $this->getDoctrine()->getManager('claseDidactica');
        $clase = $em->getRepository('TeachingClassBundle:ClaseDidactica')->findOneById($request->get('id'));


        $codigo = $this->generarCodigo($clase);


        return new Response(json_encode($codigo));
      }



     /***********************************************
     *************** FUNCIONES SERVICIOS ************
     ************************************************/

     public function escaparString($string){

        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $string = utf8_decode($string);
        $string = strtr($string, utf8_decode($originales), $modificadas);
        $string = strtolower($string);
        return utf8_encode($string);
     }

     public function generarCodigo($clase){


       $materia = $clase->getMateria();

       $codigoPrefijo = substr($this->escaparString($materia),0,1) . $clase->getId();

       $codigoSufijo = rand(1000,9999);

       $codigo = $codigoPrefijo."-".$codigoSufijo;

       return $codigo;

     }

     public function generarAuditoria($clase){

       $em = $this->getDoctrine()->getManager('claseDidactica');

       $auditoria = new AuditoriaClaseDidactica();

       $auditoria->setProfesor($this->getUser()->getId());

       $auditoria->setClase($clase->getId());

       $auditoria->setFecha(date('m-d-Y H:i:s'));

       $em->persist($auditoria);

     }





}
