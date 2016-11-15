<?php
namespace Parishop\Tests;

class SessionStub extends \PHPixie\HTTP\Context\Session\SAPI
{
    protected $sessionArray;

    protected $sessionStarted = false;

    public function __construct(&$sessionArray)
    {
        $this->sessionArray = &$sessionArray;
    }

    protected function &session()
    {
        return $this->sessionArray;
    }

    protected function sessionStart()
    {
        $this->sessionStarted = true;
    }
}