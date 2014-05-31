<?php
namespace PHPSC\PagSeguro;

use SimpleXMLElement;

interface XmlSerializable
{
    /**
     * @param SimpleXMLElement $parent
     *
     * @return SimpleXMLElement
     */
    public function xmlSerialize(SimpleXMLElement $parent);
}
