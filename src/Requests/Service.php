<?php
namespace PHPSC\PagSeguro\Requests;

use DateTime;
use PHPSC\PagSeguro\Service as BaseService;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
abstract class Service extends BaseService
{
    /**
     * @param SimpleXMLElement $obj
     *
     * @return Response
     */
    protected function getRedirection(SimpleXMLElement $obj)
    {
        return new Redirection(
            (string) $obj->code,
            new DateTime((string) $obj->date),
            $this->credentials->getUrl(static::REDIRECT_TO)
        );
    }
}
