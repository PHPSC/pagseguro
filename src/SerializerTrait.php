<?php

namespace PHPSC\PagSeguro;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use SimpleXMLElement;

/**
 * @author Vinícius Fagundes <mvlacerda@gmail.com>
 */
trait SerializerTrait
{
    /**
     * @Serializer\Exclude
     *
     * @var \JMS\Serializer\Serializer
     */
    private $serializer;

    /**
     * @return \JMS\Serializer\Serializer
     */
    public function getSerializer()
    {
        if ($this->serializer === null) {
            $this->serializer = SerializerBuilder::create()
                ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
                ->build();
        }

        return $this->serializer;
    }

    /**
     * @param SimpleXMLElement|null $xmlRoot
     *
     * @return SimpleXMLElement
     */
    public function xmlSerialize(SimpleXMLElement $xmlRoot = null)
    {
        $xmlString = $this->getSerializer()->serialize($this, 'xml');
        $xmlObject = new SimpleXMLElement($xmlString);

        if ($xmlRoot === null) {
            return $xmlObject;
        }

        $domRoot = dom_import_simplexml($xmlRoot);
        $domObject = dom_import_simplexml($xmlObject);

        $domRoot->appendChild($domRoot->ownerDocument->importNode($domObject, true));

        return $xmlRoot;
    }

    protected final function formatAmount($amount)
    {
        if ($amount === null) {
            return null;
        }

        return number_format($amount, 2, '.', '');
    }
}
