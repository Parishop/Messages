<?php
namespace Parishop;

/**
 * Class Messages
 * @package Parishop
 * @since   1.0
 */
class Messages extends \ArrayObject implements \PHPixie\Template\Extensions\Extension
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
    public function __construct($context)
    {
        parent::__construct([], 0);
        $this->context = $context;
        if($this->context) {
            if(!$this->context->session()->exists('messages')) {
                $this->context->session()->set('messages', []);
            }
            $this->messages = $this->context->session()->get('messages');
        }
    }

    /**
     * Map of method aliases
     * @return array
     * @since 1.0.1
     */
    public function aliases()
    {
        return [];
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
     * @param string $message
     * @param array  $context
     * @since 1.0.1
     */
    public function danger($message, array $context = array())
    {
        $this->log('danger', $message, $context);
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
        if($this->context) {
            $this->context->session()->set('messages', $this->messages);
        }
    }

    /**
     * Map of methods that should be available in templates.
     * @return array
     * @since 1.0.1
     */
    public function methods()
    {
        return [
            'messages' => 'asArray',
        ];
    }

    /**
     * Extension name
     * @return string
     * @since 1.0.1
     */
    public function name()
    {
        return 'messages';
    }

}

