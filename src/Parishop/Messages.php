<?php
namespace Parishop;

/**
 * Class Messages
 * @package Parishop
 * @since   1.0
 */
class Messages extends \ArrayObject
{
    use \Psr\Log\LoggerTrait;

    /**
     * @var \PHPixie\HTTP\Context
     * @since 1.0
     */
    protected $context;

    /**
     * @var array
     * @since 1.0
     */
    protected $messages = [];

    /**
     * @param \PHPixie\HTTP\Context $context
     * @since 1.0
     */
    public function __construct(\PHPixie\HTTP\Context $context)
    {
        parent::__construct([], 0);
        $this->context = $context;
        if(!$this->context->session()->exists('messages')) {
            $this->context->session()->set('messages', []);
        }
        $this->messages = $this->context->session()->get('messages');
    }

    /**
     * @return Messages\Message[]
     * @since 1.0
     */
    public function asArray()
    {
        $result = [];
        foreach($this->messages as $messages) {
            foreach($messages as $message) {
                $result[] = $message;
            }
        }

        return $result;
    }

    /**
     * @param string $level
     * @param string $message
     * @param array  $context
     * @since 1.0
     */
    public function log($level, $message, array $context = array())
    {
        $this->messages[$level][] = new Messages\Message($level, $message, $context);
        $this->context->session()->set('messages', $this->messages);
    }

}

