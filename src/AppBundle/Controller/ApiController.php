<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Model\AstronautsModel;

/**
 * @package AppBundle\Controller
 */
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

        $em = $this->getDoctrine()->getEntityManager();

        $astroModel = new AstronautsModel($em);

        switch ($reqMethod) {
          case 'GET':
                $result = $astroModel->readAstronauts($id); break;
          case 'PUT':
                $result = $astroModel->updateAstronaut($reqContent); break;
          case 'POST':
                $result = $astroModel->createAstronaut($reqContent); break;
          case 'DELETE':
                $result = $astroModel->removeAstronaut($id); break;
        }

        $response = new Response($result);

        $response->send();

        exit;
    }
}
