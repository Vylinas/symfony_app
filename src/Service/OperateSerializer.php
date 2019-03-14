<?php

namespace App\Service;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class OperateSerializer
{
    /**
     * @var Serializer
     * Serializer for one object
     */
    private $serializerOne;

    /**
     * @var Serializer
     * Serializer for many object
     */
    private $serializerMany;

    public function __construct()
    {
        $this->serializerMany   = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializerOne = new Serializer($normalizers, $encoders);
        
    }

    /**
     * @param $data waiting object|array|string to convert into Json
     * @return json decode 
     */
    public function encode($data)
    {
        return $this->serializerOne->serialize($data, 'json');
    }

    /**
     * @param $data waiting json with many oject
     * @param $class wainting class to input value of
     * @return Object[] given with set value
     */
    public function decodeMany($data, $class)
    {
        return $this->serializerMany->deserialize($data, $class, 'json');
    }

    /**
     * @param $data waiting json with one object
     * @param $class wainting class to input value of
     * @return Object given with set value
     */
    public function decodeOne($data, $class)
    {
        return $this->serializerOne->deserialize($data, $class, 'json');
    }
}
