<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Astronauts;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AstronautsController extends Controller
{
    /**
     * @Route("/astronauts", name="astronauts")
     */
    public function indexAction()
    {
		
    }
}
