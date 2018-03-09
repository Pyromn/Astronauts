<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Astronauts;
use AppBundle\Repository\AstronautsRepository;
//use Doctrine\ORM\EntityManager;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\Validator\Constraints\DateTime;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
		
		//funkční
		//$astroRepo = $this->getDoctrine()->getRepository(Astronauts::class);
		//$astronauts = $astroRepo->findAll();
	
		//$em = $this->getDoctrine()->getEntityManager();
		//$astronauts = $em->getRepository(Astronauts::class);

		
		/*
		//add
		$astronauts = new Astronauts();
	
		$astronauts->setName("Jan");
		$astronauts->setSurname("Novak");
		$astronauts->setDate(new \DateTime("11-11-1990"));
		$astronauts->setAbility("Nightvision");

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($astronauts);
		$em->flush();
		*/
		
		
		/*
		//update
		$em = $this->getDoctrine()->getEntityManager();
		
		$astronauts = $em->getRepository(Astronauts::class)->find(2);
		$astronauts->setName("Tomas");
		
		$em->persist($astronauts);
		$em->flush();
		*/
		
		
		/*
		//remove
		$em = $this->getDoctrine()->getEntityManager();
		$astronauts = $em->getRepository(Astronauts::class)->find(1);
		$em->remove($astronauts);
        $em->flush();
		*/
		
		/*
		//all
		$em = $this->getDoctrine()->getEntityManager();
		$astronauts = $em->getRepository(Astronauts::class)->findAll();
	*/
	

		$em = $this->getDoctrine()->getEntityManager();
		$astronauts = $em->getRepository(Astronauts::class)->find(2);
		
print_r($astronauts);die();

		
		// replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
