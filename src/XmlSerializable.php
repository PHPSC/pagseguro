<?php
namespace PHPSC\PagSeguro;

use InvalidArgumentException;
use SimpleXMLElement;

interface XmlSerializable
{
    /**
     * @param SimpleXMLElement $parent
     *
     * @return SimpleXMLElement
     *
     * @throws InvalidArgumentException
     */
    public function xmlSerialize(SimpleXMLElement $parent = null);
}
