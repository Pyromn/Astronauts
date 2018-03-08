<?php

namespace AppBundle\Controller;

use AppBundle\Repository\AstronautsRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ApiController extends Controller
{
    /**
     * @Route("/api", name="api")
     */
    public function indexAction()
    {
		$astro = new AstronautsRepository();
		//$astronauts = $astro->getAstronauts();
		
		//print_r($astronauts);die();
    }

}
