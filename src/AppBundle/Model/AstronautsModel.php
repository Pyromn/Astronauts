<?php

namespace AppBundle\Model;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

use AppBundle\Model\CustomGetSetMethodNormalizer;

use AppBundle\Entity\Astronauts;
use AppBundle\Repository\AstronautsRepository;

/**
 * @package AppBundle\Model
 */
class AstronautsModel
{
    public function __construct($entityManager)
    {
        $this->em = $entityManager;
    }
	
    public function readAstronauts($id = null)
    {
        if(isset($id))
            $astronauts = $this->em->getRepository(Astronauts::class)->find($id);
        else
            $astronauts = $this->em->getRepository(Astronauts::class)->findAll();

        $encoder = new JsonEncoder();
        $normalizer = new CustomGetSetMethodNormalizer();

        $callback = function ($dateTime) {
            return $dateTime instanceof \DateTime
                ? $dateTime->format('Y-m-d')
                : '';
        };

        $normalizer->setCallbacks(array('date' => $callback));

        $serializer = new Serializer([$normalizer], [$encoder]);

        $json = $serializer->serialize($astronauts, 'json');

        return $json;
    }
	
    public function updateAstronaut($json)
    {
        return $this->setAstronaut($json);
    }
	
    public function createAstronaut($json)
    {
        return $this->setAstronaut($json);
    }
	
    private function setAstronaut($json)
    {
        $encoder = new JsonEncoder();
        $normalizer = new CustomGetSetMethodNormalizer();
        $serializer = new Serializer([$normalizer], [$encoder]);

        $astronaut = $serializer->deserialize($json, Astronauts::class, 'json');

        $this->em->persist($astronaut);
        $this->em->flush();

        return '';
    }
	
    public function removeAstronaut($id)
    {
        $astronauts = $this->em->getRepository(Astronauts::class)->find($id);

        $this->em->remove($astronauts);
        $this->em->flush();
		
        return '';
    }
}
