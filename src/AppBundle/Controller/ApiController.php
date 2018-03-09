<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

use AppBundle\Model\CustomGetSetMethodNormalizer;

use AppBundle\Entity\Astronauts;
use AppBundle\Repository\AstronautsRepository;

class ApiController extends Controller
{
    /**
     * @Route("/api", name="api")
     */
    public function indexAction()
    {
		exit;
    }
	
	/**
     * @Route("/api/astronauts/{id}", defaults={"id"=null}, name="api/astronauts")
     */
	public function astronautsAction($id)
    {
		$request = Request::createFromGlobals();
		
		$reqMethod = $request->getMethod();
		
		$reqContent = $request->getContent();
		
		
		//print_r($reqMethod);
		//print_r($reqContent);die();
		
		switch ($reqMethod) {
		  case 'GET':
			$this->readAstronauts($id); break;
		  case 'PUT':
			$this->updateAstronaut($id, $reqContent); break;
		  case 'POST':
			$this->createAstronaut($reqContent); break;
		  case 'DELETE':
			$this->removeAstronaut($id); break;
		}
		
		exit;
    }
	
	private function readAstronauts($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		
		if(isset($id))
			$astronauts = $em->getRepository(Astronauts::class)->find($id);
		else
			$astronauts = $em->getRepository(Astronauts::class)->findAll();

		$encoder = new JsonEncoder();
		$normalizer = new CustomGetSetMethodNormalizer();
		$serializer = new Serializer([$normalizer], [$encoder]);

		$json = $serializer->serialize($astronauts, 'json');
		
		$response = new Response($json);
		
		$response->send();
	}
	
	private function updateAstronaut($json)
    {
		$encoder = new JsonEncoder();
		$normalizer = new CustomGetSetMethodNormalizer();
		$serializer = new Serializer([$normalizer], [$encoder]);

		$astronaut = $serializer->deserialize($json, Astronauts::class, 'json');
		
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($astronaut);
		$em->flush();
		
		exit;
	}
	
	private function createAstronaut($json)
    {
		$encoder = new JsonEncoder();
		$normalizer = new CustomGetSetMethodNormalizer();
		$serializer = new Serializer([$normalizer], [$encoder]);

		$astronaut = $serializer->deserialize($json, Astronauts::class, 'json');
		
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($astronaut);
		$em->flush();
		
		exit;
	}
	
	private function removeAstronaut($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		
		$astronauts = $em->getRepository(Astronauts::class)->find($id);
		
		$em->remove($astronauts);
        $em->flush();
		
		exit;
	}
}
