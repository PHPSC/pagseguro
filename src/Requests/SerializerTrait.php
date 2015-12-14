<?php

namespace PHPSC\PagSeguro\Requests;

use JMS\Serializer\SerializerBuilder;
use SimpleXMLElement;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;

/**
 * @author Vinícius Fagundes <mvlacerda@gmail.com>
 */
trait SerializerTrait
{
    /**
     * @var JMS\Serializer\Serializer
     */
    private $serializer;

    /**
     * @return JMS\Serializer\Serializer
     */
    public function getSerializer()
    {
        if (!$this->serializer) {
            $this->serializer = SerializerBuilder::create()
                ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
                ->build();
        }
        return $this->serializer;
    }

    /**
     * @return SimpleXMLElement
     */
    public function xmlSerialize(SimpleXMLElement $xmlRoot = null)
    {
        $xmlString = $this->getSerializer()->serialize($this, 'xml');
        $xmlObject = new SimpleXMLElement($xmlString);

        if ($xmlRoot===null) {
            return $xmlObject;
        }

        $domRoot = dom_import_simplexml($xmlRoot);
        $domObject = dom_import_simplexml($xmlObject);

        $domRoot->appendChild($domRoot->ownerDocument->importNode($domObject, true));

        return $xmlRoot;
    }
}
