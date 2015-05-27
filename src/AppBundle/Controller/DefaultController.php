<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function backendAction()
    {
        return $this->render('AppBundle:default:backendMenu.html.twig');
    }
    public function indexAction()
    {
        return $this->render('AppBundle:default:Inicio.html.twig');
    }
	public function admisionAction()
    {
        return $this->render('AppBundle:default:Admision.html.twig', array());
    }
    public function contactoAction()
	{
        return $this->render('AppBundle:default:Contacto.html.twig', array());
    }
    public function criteriospnpAction()
    {
        return $this->render('AppBundle:default:CriteriosPNP.html.twig', array());
    }
    public function estudiantesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $alumnos = $em->getRepository('AppBundle:Alumno')->findAll();
	    return $this->render('AppBundle:default:Estudiantes.html.twig', array('alumnos'=>$alumnos));
    }
    public function docentesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $docentes = $em->getRepository('AppBundle:Docente')->findAll();
	    return $this->render('AppBundle:default:Docentes.html.twig', array("docentes" => $docentes));
    }
    public function lineasIIAction()
    {
        return $this->render('AppBundle:default:LineasII.html.twig', array());
    }
    public function lineasMEAction()
    {
        return $this->render('AppBundle:default:LineasME.html.twig', array());
    }
    public function programaIIAction()
    {
        return $this->render('AppBundle:default:ProgramaII.html.twig', array());
    }
    public function programaMEAction()
    {
        return $this->render('AppBundle:default:ProgramaME.html.twig', array());
    }
    public function publicacionesAction()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://caii.itmexicali.edu.mx/es/caii/json/');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        $data = (Array)json_decode($response);
        $entities=(Array)$data["entities"];
        $tipos=(Array)$data["tipos"];
        $miembros=(Array)$data["miembros"];
        $publicaciones=(Array)$data["publicaciones"];
        $publicacionesid=(Array)$data["publicacionesid"];
        $p=array();
        $i=0;
        foreach ($entities as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $entities=$p;
        $p=array();
        $i=0;
        foreach ($tipos as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $tipos=$p;
        $p=array();
        $i=0;
        foreach ($miembros as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $miembros=$p;
        $p=array();
        $i=0;
        foreach ($publicaciones as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $publicaciones=$p;
        $p=array();
        $i=0;
        foreach ($publicacionesid as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $publicacionesid=$p;
        return $this->render('AppBundle:default:Publicaciones.html.twig', array("entities"=>$entities,"tipos"=>$tipos,"miembros"=>$miembros,"publicaciones"=>$publicaciones,"publicacionesid"=>$publicacionesid));
    }
}
