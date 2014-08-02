<?php
namespace PHPSC\PagSeguro;

use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface XmlSerializable
{
    /**
     * @param SimpleXMLElement $parent
     *
     * @return SimpleXMLElement
     */
    public function xmlSerialize(SimpleXMLElement $parent);
}
