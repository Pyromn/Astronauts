<?php

namespace AppBundle\Model;

use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * @package AppBundle\Model
 */
class CustomGetSetMethodNormalizer extends GetSetMethodNormalizer
{
	public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['date'])) {
            $data['date'] = new \DateTime($data['date']);
        }

        return parent::denormalize($data, $class, $format, $context);
    }
}
