<?php
namespace Parishop\Tests\Messages;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $message = new \Parishop\Messages\Message(\Psr\Log\LogLevel::EMERGENCY, 'emergency', []);
        $this->assertEquals(\Psr\Log\LogLevel::EMERGENCY, $message->level());
        $this->assertEquals('emergency', $message->message());
        $this->assertEquals('emergency', (string)$message);
        $this->assertEquals([], $message->context());
    }
}
