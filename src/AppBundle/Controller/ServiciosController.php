<?php
namespace CAII\PublicacionesBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CAII\PublicacionesBundle\Entity\Publicacion;
use CAII\PublicacionesBundle\Form\PublicacionLibroType;
use CAII\PublicacionesBundle\Form\PublicacionCapituloType;
use CAII\PublicacionesBundle\Form\PublicacionTesisType;
use CAII\PublicacionesBundle\Form\PublicacionInternacionalType;
use CAII\PublicacionesBundle\Form\PublicacionNacionalType;
use CAII\PublicacionesBundle\Form\PublicacionRevistaType;
use CAII\PublicacionesBundle\Form\PublicacionReporteType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;


class ServiciosController extends Controller
{
	public function InfoAction($id) 
	{
		$em = $this->getDoctrine()->getManager();
        $response = new Response();
		//variables con las que se contara en la vista para mostrar la informacion
		$listaMiembros = $em->getRepository('MiembroBundle:Miembro')->findAll();
        $miembro = null;
        foreach($listaMiembros as $m){
            if($m->getLinkPagina()==$id)
            {
                $miembro=$m;
                break;
            }
        }   	
        if($miembro){	
        //$pat=$this->container->get('templating.helper.assets')->getUrl($miembro->getFotoUrl());
		//$url=$this->getRequest()->getScheme()."://".$this->getRequest()->getHttpHost().$pat;
    		$url="http://caii.itmexicali.edu.mx/uploads/images/miembros/".$miembro->getFotoUrl();
    		$publicaciones = $em->getRepository('MiembroBundle:MiembroPublicacion')->findByidMiembro($miembro->getId());//datos que relacionan al miembro con sus publicaciones

    		$publications=array();
    		$i=0;
    		foreach ($publicaciones as $publicacion) {
    			$autores=array();
    			$k=0;
    			foreach ($publicaciones as $miembrop) {
    				if ($publicacion->getIdpublicacion() == $miembrop->getIdpublicacion())
    					$autores[$k]=$miembrop->getIdmiembro()->getNombre()." ". $miembrop->getIdmiembro()->getApellidop();
    				$k++;
    			}
    			$publications[$i]=array(
    				"type"=>$publicacion->getIdpublicacion()->getTipoPublicacion()->getNombre(),
    				"title"=>$publicacion->getIdpublicacion()->getTitulo(),
    				"chapter"=>$publicacion->getIdpublicacion()->getCapitulo(),
    				"city"=>$publicacion->getIdpublicacion()->getCiudad(),
    				"editorial"=>$publicacion->getIdpublicacion()->getEditorial(),
    				"date"=>$publicacion->getIdpublicacion()->getFecha(),
    				"pages"=>$publicacion->getIdpublicacion()->getPaginas(),
    				"doi"=>$publicacion->getIdpublicacion()->getDoi(),
    				"volume"=>$publicacion->getIdpublicacion()->getVolumen(),
    				"journal"=>$publicacion->getIdpublicacion()->getJournal(),
    				"english"=>$publicacion->getIdpublicacion()->getIdiomaIngles(),
    				"authors"=>$autores
    				);

    			$i++;
    		}
    		$info = array("id" => $miembro->getId(),"nombre" => $miembro->getNombre(),"paterno" => $miembro->getApellidop(),"materno" => $miembro->getApellidom(),"descripcion" => $miembro->getAlumDescripcion(),"link"=>$id,"fotoUrl"=>$url);
    		$response->setContent(json_encode($info));
		}
        else
        {
            $info = array("link"=>null);
            $response->setContent(json_encode($info));
        }
        $response->headers->set('Content-Type', 'application/json');
		return $response;
	}
	public function AreasAction($id) 
	{
		$em = $this->getDoctrine()->getManager();
		//variables con las que se contara en la vista para mostrar la informacion
		$listaMiembros = $em->getRepository('MiembroBundle:Miembro')->findAll();
        $miembro = null;
        $response = new Response();
        foreach($listaMiembros as $m){
            if($m->getLinkPagina()==$id)
            {
                $miembro=$m;
                break;
            }
        }
        if($miembro)
        {		
            $url=$miembro->getFotoUrl();
    		$info = array("id" => $miembro->getId(),"nombre" => $miembro->getNombre(),"paterno" => $miembro->getApellidop(),"materno" => $miembro->getApellidom(),"descripcion" => $miembro->getAlumDescripcion(),"link"=>$id,"fotoUrl"=>$url);
    		$response->setContent(json_encode($info));
        } 
        else
        {
            $info = array("link"=>'');
            $response->setContent(json_encode($info));
        }  
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}
	public function ProyectosAction($id) 
	{
		$em = $this->getDoctrine()->getManager();
		//variables con las que se contara en la vista para mostrar la información
        $listaMiembros = $em->getRepository('MiembroBundle:Miembro')->findAll();
        $miembro = null;
        $response = new Response();
        foreach($listaMiembros as $m){
            if($m->getLinkPagina()==$id)
            {
                $miembro=$m;
                break;
            }
        }
        if($miembro)
        {
		$pDirigidos = $em->getRepository('ProyectoBundle:Proyecto')->findByDirector($miembro->getId());//proyectos que dirigio
		$proyectos = $em->getRepository('MiembroBundle:MiembroProyecto')->findByidMiembro($miembro->getId());//proyectos en los que trabajó
		$todos = $em->getRepository('MiembroBundle:MiembroProyecto')->findAll();//envio de datos restantes
		$i=0;
		$projects=array();
		foreach ($pDirigidos as $dir)
                {
			$proyecto=$em->getRepository('MiembroBundle:MiembroProyecto')->findByidProyecto($dir->getId());
                        $x=0;
                        $otros=array();
                        foreach ($proyecto as $otro)
                        {
                                        $otros[$x]=$otro->getIdmiembro()->getNombre()." ".$otro->getIdmiembro()->getApellidop();
                                        $x++;
                        }
                        $projects[$i]=array(
                        "nombre"=>$dir->getNombre(),
                        "miembro"=>$dir->getDirector()->getNombre()." ".$dir->getDirector()->getApellidop(),
                        "fechaini"=>$dir->getFechaInicio(),
                        "fechafin"=>$fecha=$dir->getFechaFinal(),
                        "director"=>$dir->getDirector()->getNombre()." ".$dir->getDirector()->getApellidop(),
                        "colaboradores"=>$otros
                        );
                        $i++;
                }
		foreach ($proyectos as $proyecto)
		{
			$j=0;
			$otros=array();
			foreach ($todos as $otro)
			{
				if ($otro->getIdproyecto()->getId()==$proyecto->getIdproyecto()->getId() and $proyecto->getIdmiembro()->getId()!=$otro->getIdmiembro()->getId())
				{
					$otros[$j]=$otro->getIdmiembro()->getNombre()." ".$otro->getIdmiembro()->getApellidop();
					$j++;
				}
			}
			$projects[$i]=array(
			"nombre"=>$proyecto->getIdproyecto()->getNombre(),
			"miembro"=>$proyecto->getIdmiembro()->getNombre()." ".$proyecto->getIdmiembro()->getApellidop(),
			"fechaini"=>$proyecto->getIdproyecto()->getFechaInicio(),
			"fechafin"=>$fecha=$proyecto->getIdproyecto()->getFechaFinal(),
			"director"=>$proyecto->getIdproyecto()->getDirector(),
			"colaboradores"=>$otros
			);
			$i++;
		}
		$member = array("id" => $miembro->getId(),"nombre" => $miembro->getNombre(),"paterno" => $miembro->getApellidop(),"materno" => $miembro->getApellidom(),"descripcion" => $miembro->getAlumDescripcion(),"link"=>$id);
		$info=array("miembro" => $member,"proyectos" => $projects);
		$response->setContent(json_encode($info));
        }
        else
        {
            $info = array("link"=>null);
            $response->setContent(json_encode($info));
        }
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}
	public function PublicacionesAction($id,Request $request)//carga la pagina personal del usuario en la vista de publicaciones y conferencias
	{
		$em = $this->getDoctrine()->getManager();
        $listaMiembros = $em->getRepository('MiembroBundle:Miembro')->findAll();
        $miembro = null;
        foreach($listaMiembros as $m){
            if($m->getLinkPagina()==$id)
            {
                $miembro=$m;
                break;
            }
        }
        $dql = $em->createQueryBuilder();
        $localeLang = $request->attributes->get('_locale', $request->getLocale());
        if($localeLang=='es')
        {
            //Query para tipos de publicacion 
            $dql->select('TipoPublicacion.nombre','TipoPublicacion.id')
                ->from('PublicacionesBundle:Publicacion', 'Publicacion')
                ->Join('Publicacion.TipoPublicacion', 'TipoPublicacion')
                ->orderBy('TipoPublicacion.prioridad', 'ASC')
                ->groupBy('Publicacion.TipoPublicacion');
            $tipos =$dql->getQuery()->getResult();

            //Nombre de los publicaciones
            $publicaciones = $em->getRepository('PublicacionesBundle:TipoPublicacion')->findAll();

            //Nombre de los publicaciones
            $publicacionesid = $em->getRepository('MiembroBundle:MiembroPublicacion')->findByIdMiembro($miembro->getId());

            //Query para las publicaciones ordenadas por fecha
            $repository = $this->getDoctrine()
                        ->getRepository('PublicacionesBundle:Publicacion');
            $dql = $repository->createQueryBuilder('p')
                    ->select('p')
                    ->orderBy('p.fecha', 'DESC');
            $entities =$dql->getQuery()->getResult();
            //Query miembros-publicacion
            $dql->select('MiembroPublicacion.id i', 
                         'Miembro.nombre nombreMiembro, Miembro.apellidoP', 
                         'Publicacion.id idpublicacion')
                ->from('MiembroBundle:MiembroPublicacion', 'MiembroPublicacion')
                ->Join('MiembroPublicacion.idMiembro', 'Miembro')
                ->Join('MiembroPublicacion.idPublicacion', 'Publicacion')
                ->groupBy('MiembroPublicacion.id')
                ->orderBy('MiembroPublicacion.id');

            $miembros=$dql->getQuery()->getResult();
        
        }
        else{
            //Query para tipos de publicacion 
            $dql->select('TipoPublicacion.nombre','TipoPublicacion.id')
                ->from('PublicacionesBundle:Publicacion', 'Publicacion')
                ->Join('Publicacion.TipoPublicacion', 'TipoPublicacion')
                ->Where('Publicacion.idiomaIngles = 1')
                ->orderBy('TipoPublicacion.prioridad', 'ASC')
                ->groupBy('Publicacion.TipoPublicacion');
            $tipos =$dql->getQuery()->getResult();

            //Nombre de los publicaciones
            $publicaciones = $em->getRepository('PublicacionesBundle:TipoPublicacion')->findAll();

            //Nombre de los publicaciones
            $publicacionesid = $em->getRepository('MiembroBundle:MiembroPublicacion')->findByIdMiembro($miembro->getId());

            //Query para las publicaciones ordenadas por fecha
            $repository = $this->getDoctrine()
                        ->getRepository('PublicacionesBundle:Publicacion');
            $dql = $repository->createQueryBuilder('p')
                    ->select('p')
                    ->where('p.idiomaIngles=1')
                    ->orderBy('p.fecha', 'DESC');
            $entities =$dql->getQuery()->getResult();
            //Query miembros-publicacion
            $dql->select('MiembroPublicacion.id i', 
                         'Miembro.nombre nombreMiembro, Miembro.apellidoP', 
                         'Publicacion.id idpublicacion')
                ->from('MiembroBundle:MiembroPublicacion', 'MiembroPublicacion')
                ->Join('MiembroPublicacion.idMiembro', 'Miembro')
                ->Join('MiembroPublicacion.idPublicacion', 'Publicacion')
                ->groupBy('MiembroPublicacion.id')
                ->orderBy('MiembroPublicacion.id');

            $miembros=$dql->getQuery()->getResult();
        }


		$types = array();
        $i=0;
        foreach ($tipos as $tipo) {
            $types[$i]=(array)$tipo;
            $i++;
        }

        $entidades = array();
        $i=0;
        foreach ($entities as $entidad) {
            $entidades[$i]=array(
                "id"=> $entidad->getId(),
                "path"=>$entidad->path,
                "doi" => $entidad->getDoi(),
                "paginas" => $entidad->getPaginas(),
                "titulo" => $entidad->getTitulo(),
                "tituloLibro" => $entidad->getTituloLibro(),
                "fecha" => $entidad->getFecha(),
                "enlace" => $entidad->getEnlace(),
                "tipoReporte" => $entidad->getTipoReporte(),
                "ciudad" => $entidad->getCiudad(),
                "congreso" => $entidad->getCongreso(),
                "issn" => $entidad->getIssn(),
                "capitulo" => $entidad->getCapitulo(),
                "isbn" => $entidad->getIsbn(),
                "journal" => $entidad->getjournal(),
                "volumen" => $entidad->getVolumen(),
                "editorial" => $entidad->getEditorial(),
                "serie" => $entidad->getSerie(),
                "edicion" => $entidad->getEdicion(),
                "tipoTesis" => $entidad->getTipoTesis()
                );
            $i++;
        }

        $publications=array();
        $i=0;
        foreach ($publicaciones as $publicacion) {
            $publications[$i]= array(
                    "id" => $publicacion->getId(),
                    "nombre" => $publicacion->getNombre(),
                    "prioridad" => $publicacion->getPrioridad()
                    );
            $i++;
        }

        $publicationsid=array();
        $i=0;
        foreach ($publicacionesid as $publicacion) {
        $publicationsid[$i]= array(
            "id" => $publicacion->getIdPublicacion()->getId(),
            "tipoPublicacion" => $publicacion->getIdPublicacion()->getTipoPublicacion()->getNombre(),
            "doi" => $publicacion->getIdPublicacion()->getDoi(),
            "paginas" => $publicacion->getIdPublicacion()->getPaginas(),
            "titulo" => $publicacion->getIdPublicacion()->getTitulo(),
            "tituloLibro" => $publicacion->getIdPublicacion()->getTituloLibro(),
            "fecha" => $publicacion->getIdPublicacion()->getFecha(),
            "enlace" => $publicacion->getIdPublicacion()->getEnlace(),
            "tipoReporte" => $publicacion->getIdPublicacion()->getTipoReporte(),
            "ciudad" => $publicacion->getIdPublicacion()->getCiudad(),
            "congreso" => $publicacion->getIdPublicacion()->getCongreso(),
            "issn" => $publicacion->getIdPublicacion()->getIssn(),
            "capitulo" => $publicacion->getIdPublicacion()->getCapitulo(),
            "isbn" => $publicacion->getIdPublicacion()->getIsbn(),
            "mostrar" => $publicacion->getIdPublicacion()->getMostrar(),
            "journal" => $publicacion->getIdPublicacion()->getjournal(),
            "volumen" => $publicacion->getIdPublicacion()->getVolumen(),
            "editorial" => $publicacion->getIdPublicacion()->getEditorial(),
            "serie" => $publicacion->getIdPublicacion()->getSerie(),
            "edicion" => $publicacion->getIdPublicacion()->getEdicion(),
            "escuela" => $publicacion->getIdPublicacion()->getEscuela(),
            "tipoTesis" => $publicacion->getIdPublicacion()->getTipoTesis(),
            "idiomaIngles" => $publicacion->getIdPublicacion()->getIdiomaIngles()
            );
        $i++;
        }
        $member = array("id" => $miembro->getId(),"nombre" => $miembro->getNombre(),"paterno" => $miembro->getApellidop(),"materno" => $miembro->getApellidom(),"descripcion" => $miembro->getAlumDescripcion(),"link"=>$id);
        $info = array(
        'miembro' => $member,
        'entities' => $entidades,
        'tipos' => $types,
        'miembros'=>$miembros,
        'publicaciones'=>$publications,
        'publicacionesid'=>$publicationsid,
        );
        $response = new Response();
        $response->setContent(json_encode($info));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
	}
	public function PublicacionesCaiiAction(Request $request)//carga la pagina personal del usuario en la vista de publicaciones y conferencias
	{
		$em = $this->getDoctrine()->getManager();
        $dql = $em->createQueryBuilder();

            //Query para tipos de publicacion 
            $dql->select('TipoPublicacion.nombre','TipoPublicacion.id')
                ->from('PublicacionesBundle:Publicacion', 'Publicacion')
                ->Join('Publicacion.TipoPublicacion', 'TipoPublicacion')
                ->orderBy('TipoPublicacion.prioridad', 'ASC')
                ->groupBy('Publicacion.TipoPublicacion');
            $tipos =$dql->getQuery()->getResult();

            //Nombre de los publicaciones
            $publicaciones = $em->getRepository('PublicacionesBundle:TipoPublicacion')->findAll();

            //Nombre de los publicaciones
            $publicacionesid = $em->getRepository('PublicacionesBundle:Publicacion')->findAll();

            //Query para las publicaciones ordenadas por fecha
            $repository = $this->getDoctrine()
                        ->getRepository('PublicacionesBundle:Publicacion');
            $dql = $repository->createQueryBuilder('p')
                    ->select('p')
                    ->orderBy('p.fecha', 'DESC');
            $entities =$dql->getQuery()->getResult();
            //Query miembros-publicacion
            $dql->select('MiembroPublicacion.id i', 
                         'Miembro.nombre nombreMiembro, Miembro.apellidoP', 
                         'Publicacion.id idpublicacion')
                ->from('MiembroBundle:MiembroPublicacion', 'MiembroPublicacion')
                ->Join('MiembroPublicacion.idMiembro', 'Miembro')
                ->Join('MiembroPublicacion.idPublicacion', 'Publicacion')
                ->groupBy('MiembroPublicacion.id')
                ->orderBy('MiembroPublicacion.id');

            $miembros=$dql->getQuery()->getResult();
        
        $types = array();
        $i=0;
        foreach ($tipos as $tipo) {
        	$types[$i]=(array)$tipo;
        	$i++;
        }

        $entidades = array();
        $i=0;
        foreach ($entities as $entidad) {
        	$entidades[$i]=array(
        		"id"=> $entidad->getId(),
        		"path"=>$entidad->path,
        		"doi" => $entidad->getDoi(),
			    "paginas" => $entidad->getPaginas(),
			    "titulo" => $entidad->getTitulo(),
			    "tituloLibro" => $entidad->getTituloLibro(),
			    "fecha" => $entidad->getFecha(),
			    "enlace" => $entidad->getEnlace(),
			    "tipoReporte" => $entidad->getTipoReporte(),
			    "ciudad" => $entidad->getCiudad(),
			    "congreso" => $entidad->getCongreso(),
			    "issn" => $entidad->getIssn(),
			    "capitulo" => $entidad->getCapitulo(),
			    "isbn" => $entidad->getIsbn(),
			    "journal" => $entidad->getjournal(),
			    "volumen" => $entidad->getVolumen(),
			    "editorial" => $entidad->getEditorial(),
			    "serie" => $entidad->getSerie(),
			    "edicion" => $entidad->getEdicion(),
			    "tipoTesis" => $entidad->getTipoTesis()
        		);
        	$i++;
        }

		$publications=array();
		$i=0;
		foreach ($publicaciones as $publicacion) {
		    $publications[$i]= array(
		            "id" => $publicacion->getId(),
		            "nombre" => $publicacion->getNombre(),
		            "prioridad" => $publicacion->getPrioridad()
		            );
		    $i++;
		}

        $publicationsid=array();
		$i=0;
		foreach ($publicacionesid as $publicacion) {
		$publicationsid[$i]= array(
		    "id" => $publicacion->getId(),
		    "tipoPublicacion" => $publicacion->getTipoPublicacion()->getNombre(),
		    "doi" => $publicacion->getDoi(),
		    "paginas" => $publicacion->getPaginas(),
		    "titulo" => $publicacion->getTitulo(),
		    "tituloLibro" => $publicacion->getTituloLibro(),
		    "fecha" => $publicacion->getFecha(),
		    "enlace" => $publicacion->getEnlace(),
		    "tipoReporte" => $publicacion->getTipoReporte(),
		    "ciudad" => $publicacion->getCiudad(),
		    "congreso" => $publicacion->getCongreso(),
		    "issn" => $publicacion->getIssn(),
		    "capitulo" => $publicacion->getCapitulo(),
		    "isbn" => $publicacion->getIsbn(),
		    "mostrar" => $publicacion->getMostrar(),
		    "journal" => $publicacion->getjournal(),
		    "volumen" => $publicacion->getVolumen(),
		    "editorial" => $publicacion->getEditorial(),
		    "serie" => $publicacion->getSerie(),
		    "edicion" => $publicacion->getEdicion(),
		    "escuela" => $publicacion->getEscuela(),
		    "tipoTesis" => $publicacion->getTipoTesis(),
		    "idiomaIngles" => $publicacion->getIdiomaIngles()
		    );
		$i++;
 
        }
		$publications = array(
		'entities' => $entidades,
		'tipos' => $types,
		'miembros'=>$miembros,
		'publicaciones'=>$publications,
		'publicacionesid'=>$publicationsid,
		);
		    $response = new Response();
		    $response->setContent(json_encode($publications));
		    $response->headers->set('Content-Type', 'application/json');
		    return $response;
	}
	public function investigadoresAction()
	{
		$em = $this->getDoctrine()->getManager();
		$miembros = $em->getRepository('MiembroBundle:Miembro')->findAll();//información personal del miembro
		$data = array();
		$i = 0;
		foreach ($miembros as $miembro) 
		{
			$url="caii.itmexicali.edu.mx/uploads/images/miembros/".$miembro->getFotoUrl();
			$data[$i] = array("id" => $miembro->getId(),"nombre" => $miembro->getNombre(),"paterno" => $miembro->getApellidop(),"materno" => $miembro->getApellidom(),"pagina" => $miembro->getLinkPagina(),"fotoUrl" => $url);
			$i = $i + 1;
		}
		$response = new Response();
		$response->setContent(json_encode($data));
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}
}

