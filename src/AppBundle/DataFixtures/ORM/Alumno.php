<?php
	namespace AppBundle\DataFixtures\ORM;
	use Doctrine\Common\DataFixtures\AbstractFixture;
	use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
	use Doctrine\Common\DataFixtures\ReferenceRepository;
	use Doctrine\Common\Persistence\ObjectManager;
	use AppBundle\Entity\Alumno;
	
	class Alumnos extends AbstractFixture implements OrderedFixtureInterface
	{
		public function load(ObjectManager $manager)
		{
			$miembros = array(
				//Estudiantes de maestria
array('nombre' => 'Francisco Javier','apellidoP' => 'Guayante','apellidoM' => 'Santacruz','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Francisco Alan','apellidoP' => 'Bonino','apellidoM' => 'Deras','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Leslye','apellidoP' => 'Ibarra','apellidoM' => 'Lares','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Jazmin Alexandriny','apellidoP' => 'Jiménez','apellidoM' => 'Contreras','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Jose Alberto','apellidoP' => 'Lopez','apellidoM' => 'Cazares','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Edgar Alberto','apellidoP' => 'Dominguez','apellidoM' => 'Araiza','titulo' => '1','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Omar','apellidoP' => 'Delgadillo','apellidoM' => 'Quezada','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Alberto','apellidoP' => 'Urbina','apellidoM' => 'Espinoza','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Fabián Natanael','apellidoP' => 'Murrieta','apellidoM' => 'Rico','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Jorge Antonio','apellidoP' => 'Atempa','apellidoM' => 'Camacho','titulo' => '1','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Steven','apellidoP' => 'Delgadillo','apellidoM' => 'Quezada','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Oscar Rubén','apellidoP' => 'Batista','apellidoM' => 'Gaxiola','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Oskardie','apellidoP' => 'Castro','apellidoM' => 'Chicatti','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Félix Francisco','apellidoP' => 'Reyna','apellidoM' => 'Beltrán','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Blanca A.','apellidoP' => 'Marrujo','apellidoM' => 'Verdugo','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Fernando Emmanuel','apellidoP' => 'Michel','apellidoM' => 'Avila','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo'),
array('nombre' => 'Dulce Karina','apellidoP' => 'Orduño','apellidoM' => 'Valenzuela','titulo' => '0','generacion' => '',
	'email' => '','areaInteres'=>'computo ubicuo')
			);


			foreach ($miembros as $miembro) {
				$entidad = new Alumno();
				$entidad->setNombre($miembro['nombre']);
				$entidad->setApellidoP($miembro['apellidoP']);
				$entidad->setApellidoM($miembro['apellidoM']);
				$entidad->setEmail($miembro['email']);
				$entidad->setTitulo($miembro['titulo']);
				$entidad->setGeneracion($miembro['generacion']);
				$entidad->setAreaInteres($miembro['areaInteres']);
				$manager->persist($entidad);
				$manager->flush();
			}
		}
		public function getOrder()
	    {
	        return 1; // the order in which fixtures will be loaded
	    }
	}
