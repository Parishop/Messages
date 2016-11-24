<?php
namespace Parishop\Tests;

class MessagesTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Parishop\Messages */
    protected $messages;

    public function setUp()
    {
        $array          = [];
        $session        = new SessionStub($array);
        $context        = new \PHPixie\HTTP\Context(null, null, $session);
        $this->messages = new \Parishop\Messages($context);
    }

    public function testAliases()
    {
        $this->assertEquals([], $this->messages->aliases());
    }

    public function testError()
    {
        $this->messages->danger('danger');
        $message = new \Parishop\Messages\Message('danger', 'danger');
        $this->assertEquals([$message], $this->messages->asArray());
    }

    public function testMethods()
    {
        $this->assertEquals(['messages' => 'asArray'], $this->messages->methods());
    }

    public function testName()
    {
        $this->assertEquals('messages', $this->messages->name());
    }

}

