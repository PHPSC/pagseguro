<?php
namespace PHPSC\PagSeguro\ValueObject;

use PHPSC\PagSeguro\Customer\Phone;

class Sender
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Phone
     */
    private $phone;

    /**
     * @param string $email
     * @param string $name
     * @param Phone $phone
     */
    public function __construct(
        $email,
        $name = null,
        Phone $phone = null
    ) {
        $this->phone = $phone;
        $this->setEmail($email);

        if ($name !== null) {
            $this->setName($name);
        }
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    protected function setEmail($email)
    {
        $this->email = substr($email, 0, 60);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = substr($name, 0, 50);
    }

    /**
     * @return Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
