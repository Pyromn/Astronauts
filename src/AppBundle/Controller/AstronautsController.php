<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Astronauts;
//use AppBundle\Repository\AstronautsRepository;
//use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

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
		$articles = new Astronauts();
		
		
		
		return new Response('Genus created!');
		
		
		//$articleRepository = $this->container->get('astronauts_repository');
	/*	
		$article = $articleRepository->getArticles();
		
		return $this->render('AppBundle:Article:index.html.twig', [
                        'article' => $article
                ]);
	*/			
    }

}
