<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Astronauts;
use AppBundle\Model\AstronautsModel;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $data = $this->getDataFromRepository();
        //$data = $this->getDataFromRestApi();
   
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'astronauts' => $data
        ]);
    }
    
    /**
     * @Route("/add", name="add")
     */
    public function addAction(Request $request)
    {
        $astronauts = new Astronauts();
        
        $form = $this->createFormBuilder($astronauts)
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('date', DateType::class, array(
                 'years' => range(date('Y'), date('Y')-100),
               ))
            ->add('ability', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Vytvořit'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $astronaut = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($astronaut);
            $entityManager->flush();
            
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", defaults={"id"=null}, name="edit")
     */
    public function editAction($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $astronaut = $entityManager->getRepository(Astronauts::class)->find($id);

        $form = $this->createFormBuilder($astronaut)
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('date', DateType::class, array(
                 'years' => range(date('Y'), date('Y')-100),
               ))
            ->add('ability', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Upravit'))
            ->getForm();

        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

            $astronaut = $form->getData();

            $entityManager->persist($astronaut);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    private function getDataFromRepository()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $astroModel = new AstronautsModel($em);
        
        $json = $astroModel->readAstronauts();

        $data = json_decode($json, true);
        
        return $data;
    }
    
    private function getDataFromRestApi()
    {
        $request = Request::createFromGlobals();
        
        $serverName = $request->getHost();
        //$serverName = "http://astronauts.com.h";

        $opts = array('http'=>array('method'=>"GET"));

        $context = stream_context_create($opts);

        $json = file_get_contents($serverName . '/api/astronauts', false, $context);
        
        $data = json_decode($json, true);
        
        return $data;
    }
}
