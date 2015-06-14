<?php
	namespace AppBundle\DataFixtures\ORM;
	use Doctrine\Common\DataFixtures\AbstractFixture;
	use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
	use Doctrine\Common\DataFixtures\ReferenceRepository;
	use Doctrine\Common\Persistence\ObjectManager;
	use AppBundle\Entity\Docente;
	
	class Docentes extends AbstractFixture implements OrderedFixtureInterface
	{
		public function load(ObjectManager $manager)
		{
			$miembros = array(

array('nombre' => 'Arnoldo','apellidoP' => 'Díaz-Ramírez','apellidoM' => '','email' => '1','titulo' => '',
	'enlacePagina' => '','areaInteres'=>'Computo Ubicuo'),
array('nombre' => 'Francisco','apellidoP' => 'Ibáñez','apellidoM' => 'Salas','email' => '1','titulo' => '',
	'enlacePagina' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Claudia','apellidoP' => 'Martínez','apellidoM' => 'Castillo','email' => '1','titulo' => '',
	'enlacePagina' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Verónica','apellidoP' => 'Quintero','apellidoM' => 'Rosas','email' => '1','titulo' => '',
	'enlacePagina' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Heber Samuel','apellidoP' => 'Hernández','apellidoM' => 'Tabares','email' => '0','titulo' => '',
	'enlacePagina' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Vidblaín','apellidoP' => 'Amaro','apellidoM' => 'Ortega','email' => '0','titulo' => '',
	'enlacePagina' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Luis Aram','apellidoP' => 'Tafoya','apellidoM' => 'Díaz','email' => '0','titulo' => '',
	'enlacePagina' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Jesus','apellidoP' => 'Olvera','apellidoM' => '','email' => '0','titulo' => '',
	'enlacePagina' => '','areaInteres'=>'computo ubicuo')


			);

			
			foreach ($miembros as $miembro) {
				$entidad = new Docente();
				$entidad->setNombre($miembro['nombre']);
				$entidad->setApellidoP($miembro['apellidoP']);
				$entidad->setApellidoM($miembro['apellidoM']);
				$entidad->setEmail($miembro['email']);
				$entidad->setTitulo($miembro['titulo']);
				$entidad->setEnlacePagina($miembro['enlacePagina']);
				$entidad->setAreaInteres($miembro['areaInteres']);
				$manager->persist($entidad);
				$manager->flush();
			}
		}
		public function getOrder()
	    {
	        return 2; // the order in which fixtures will be loaded
	    }
	}
