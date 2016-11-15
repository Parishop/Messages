<?php
namespace Parishop\Tests;

class MessagesTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $array    = [];
        $session  = new SessionStub($array);
        $context  = new \PHPixie\HTTP\Context(null, null, $session);
        $messages = new \Parishop\Messages($context);
        $messages->log(\Psr\Log\LogLevel::EMERGENCY, 'emergency');
        $message = new \Parishop\Messages\Message(\Psr\Log\LogLevel::EMERGENCY, 'emergency');
        $this->assertEquals([$message], $messages->asArray());
    }

}
